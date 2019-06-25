<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

function getContributors($filters = []) {
  $where = getWhereContributors($filters);
  $query =
    "SELECT
      contributors.id,
      contributors.issue_id,
      contributors.creator_id,
      contributors.creator_type_id,
      creators.id AS creator_id,
      creators.name AS creator,
      creator_types.id AS creator_type_id,
      creator_types.name AS creator_type
    FROM contributors
    LEFT JOIN creators ON contributors.creator_id = creators.id
    LEFT JOIN creator_types ON contributors.creator_type_id = creator_types.id
    {$where}";

  $contributors = select($query, 'kittenb1_longbox');

  return [
    'count'   => count($contributors),
    'filters' => $filters,
    'query'   => $query,
    'results' => $contributors
  ];
}

function getData() {
  $filters              = parseFilters();
  $contributorsFiltered = getContributors($filters);

  // Limit issues based on filtered contributors
  if (count($filters['contributors']) > 0) {
    foreach ($contributorsFiltered['results'] as $contributor) {
      if (!in_array($contributor['issue_id'], $filters['issues']['issueIds'])) {
        $filters['issues']['issueIds'][] = $contributor['issue_id'];
      }
    }
  }

  $issues       = getIssues($filters);
  $contributors = getContributors();

  // Add all contributors to any matching issues
  foreach ($issues['results'] as $index => $issue) {
    foreach ($contributors['results'] as $contributor) {
      if ($contributor['issue_id'] === $issue['id']) {
        $issues['results'][$index]['contributors'][] = $contributor;
      }
    }
  }

  $response = [
    'success'      => !($issues['results'] === 'FALSE') && !($contributors['results'] === 'FALSE'),
    'contributors' => $contributorsFiltered,
    'issues'       => $issues,
  ];

  return $response;
}

function getIssues($filters = []) {
  $where   = getWhereIssues($filters);
  $isDesc  = is_null($filters['is_desc']) ? 'ASC' : 'DESC';
  $orderBy = is_null($filters['order_by']) ? '' : 'ORDER BY ' . $filters['order_by'] . ' ' . $isDesc;
  $query   =
    "SELECT
      issues.id,
      issues.title_id,
      issues.publisher_id,
      issues.format_id,
      issues.number,
      issues.notes,
      issues.year,
      issues.is_read,
      issues.is_owned,
      issues.is_color,
      titles.id AS title_id,
      titles.name AS title,
      publishers.id AS publisher_id,
      publishers.name AS publisher,
      formats.id AS format_id,
      formats.name as format
    FROM issues
    LEFT JOIN titles ON title_id = titles.id
    LEFT JOIN publishers ON publisher_id = publishers.id
    LEFT JOIN formats ON format_id = formats.id
    {$where}
    {$orderBy}";

  $issues = select($query, 'kittenb1_longbox');

  return [
    'count'   => count($issues),
    'filters' => $filters,
    'query'   => $query,
    'results' => $issues
  ];
}

function getWhereContributors($filters = []) {
  $delimiter          = is_null($filters['delimiter']) ? 'AND' : " {$filters['delimiter']} ";
  $whereContributors  = '';
  $contributorFilters = [];

  if (!is_null($filters['contributors']['creator'])) {
    if (strpos($filters['contributors']['creator'], ',') > -1) {
      $creators             = explode(',', $filters['contributors']['creator']);
      $contributorFilters[] = "(creators.name LIKE '%" . implode("%' OR creators.name LIKE '%", $creators) . "%')";
    } else {
      $contributorFilters[] = "creators.name LIKE '%" . $filters['contributors']['creator'] . "%'";
    }
  }

  if (!is_null($filters['contributors']['cover'])) {
    if (strpos($filters['contributors']['cover'], ',') > -1) {
      $creators             = explode(',', $filters['contributors']['cover']);
      $contributorFilters[] = "creator_types.name = 'cover' AND (creators.name LIKE '%" . implode("' OR creators.name LIKE '%", $creators) . "%')";
    } else {
      $contributorFilters[] = "creator_types.name = 'cover' AND creators.name LIKE '%" . $filters['contributors']['cover'] . "%'";
    }
  }

  if (!is_null($filters['contributors']['writer'])) {
    if (strpos($filters['contributors']['writer'], ',') > -1) {
      $creatorTypeIds       = explode(',', $filters['contributors']['writer']);
      $contributorFilters[] = "creator_types.name = 'writer' AND (creators.name LIKE '%" . implode("' OR creators.name LIKE '%", $creatorTypeIds) . "%')";
    } else {
      $contributorFilters[] = "creator_types.name = 'writer' AND creators.name LIKE '%" . $filters['contributors']['writer'] . "%'";
    }
  }

  if (!is_null($filters['contributors']['interior'])) {
    if (strpos($filters['contributors']['interior'], ',') > -1) {
      $creators             = explode(',', $filters['contributors']['interior']);
      $contributorFilters[] = "creator_types.name = 'interior' AND (creators.name LIKE '%" . implode("' OR creators.name LIKE '%", $creators) . "%')";
    } else {
      $contributorFilters[] = "creator_types.name = 'interior' AND creators.name LIKE '%" . $filters['contributors']['interior'] . "%'";
    }
  }

  if (!is_null($filters['contributors']['creator_id'])) {
    if (strpos($filters['contributors']['creator_id'], ',') > -1) {
      $creatorIds           = explode(',', $filters['contributors']['creator_id']);
      $contributorFilters[] = "(creators.id = '" . implode("' OR creators.id = '", $creatorIds) . "')";
    } else {
      $contributorFilters[] = "creators.id = '" . $filters['contributors']['creator_id'] . "'";
    }
  }

  if (!is_null($filters['contributors']['creator_type'])) {
    if (strpos($filters['contributors']['creator_type'], ',') > -1) {
      $creatorTypes       = explode(',', $filters['contributors']['creator_type']);
      $contributorFilters[] = "(creator_types.name = '" . implode("' OR creator_types.name = '", $creatorTypes) . "')";
    } else {
      $contributorFilters[] = "creator_types.name = '" . $filters['contributors']['creator_type'] . "'";
    }
  }

  if (!is_null($filters['contributors']['creator_type_id'])) {
    if (strpos($filters['contributors']['creator_type_id'], ',') > -1) {
      $creatorTypeIds       = explode(',', $filters['contributors']['creator_type_id']);
      $contributorFilters[] = "(creator_types.id = '" . implode("' OR creator_types.id = '", $creatorTypeIds) . "')";
    } else {
      $contributorFilters[] = "creator_types.id = '" . $filters['contributors']['creator_type_id'] . "'";
    }
  }

  if (count($contributorFilters) > 0) {
    $whereContributors = 'WHERE ' . implode(" {$delimiter} ", $contributorFilters);
  }

  return $whereContributors;
}

function getWhereIssues($filters = []) {
  $delimiter    = is_null($filters['delimiter']) ? 'AND' : $filters['delimiter'];
  $whereIssues  = '';
  $issueFilters = [];

  if (!is_null($filters['issues']['format'])) {
    if (strpos($filters['issues']['format'], ',') > -1) {
      $formats        = explode(',', $filters['issues']['format']);
      $issueFilters[] = "(formats.name = '" . implode("' OR formats.name = '", $formats) . "')";
    } else {
      $issueFilters[] = "formats.name = '" . $filters['issues']['format'] . "'";
    }
  }

  if (!is_null($filters['issues']['format_id'])) {
    if (strpos($filters['issues']['format_id'], ',') > -1) {
      $formatIds      = explode(',', $filters['issues']['format_id']);
      $issueFilters[] = "(formats.id = '" . implode("' OR formats.id = '", $formatIds) . "')";
    } else {
      $issueFilters[] = "formats.id = '" . $filters['issues']['format_id'] . "'";
    }
  }

  if (!is_null($filters['issues']['is_color'])) {
    $issueFilters[] = "is_color = '" . $filters['issues']['is_color'] . "'";
  }

  if (!is_null($filters['issues']['is_owned'])) {
    $issueFilters[] = "is_owned = '" . $filters['issues']['is_owned'] . "'";
  }

  if (!is_null($filters['issues']['is_read'])) {
    $issueFilters[] = "is_read = '" . $filters['issues']['is_read'] . "'";
  }

  if (!is_null($filters['issues']['number'])) {
    if (strpos($filters['issues']['number'], ',') > -1) {
      $numbers        = explode(',', $filters['issues']['number']);
      $issueFilters[] = "(number = " . implode(' OR number = ', $numbers) . ")";
    } else {
      $issueFilters[] = "number = '" . $filters['issues']['number'] . "'";
    }
  }

  if (!is_null($filters['issues']['notes'])) {
    if (strpos($filters['issues']['notes'], ',') > -1) {
      $notes          = explode(',', $filters['issues']['notes']);
      $issueFilters[] = "(notes LIKE '%" . implode("%' OR notes LIKE '", $notes) . "%')";
    } else {
      $issueFilters[] = "notes LIKE '%" . $filters['issues']['notes'] . "%'";
    }
  }

  if (!is_null($filters['issues']['publisher'])) {
    if (strpos($filters['issues']['publisher'], ',') > -1) {
      $publisher      = explode(',', $filters['issues']['publisher']);
      $issueFilters[] = "(publishers.name LIKE '%" . implode("%' OR publishers.name LIKE '%", $publisher) . "%')";
    } else {
      $issueFilters[] = "publishers.name LIKE '%" . $filters['issues']['publisher'] . "%'";
    }
  }

  if (!is_null($filters['issues']['publisher_id'])) {
    if (strpos($filters['issues']['publisher_id'], ',') > -1) {
      $publisherIds   = explode(',', $filters['issues']['publisher_id']);
      $issueFilters[] = "(publishers.id = '" . implode("' OR publishers.id = '", $publisherIds) . "')";
    } else {
      $issueFilters[] = "publishers.id = '" . $filters['issues']['publisher_id'] . "'";
    }
  }

  if (!is_null($filters['issues']['title'])) {
    if (strpos($filters['issues']['title'], ',') > -1) {
      $title          = explode(',', $filters['issues']['title']);
      $issueFilters[] = "(titles.name LIKE '%" . implode("%' OR titles.name LIKE '%", $title) . "%')";
    } else {
      $issueFilters[] = "titles.name LIKE '%" . $filters['issues']['title'] . "%'";
    }
  }

  if (!is_null($filters['issues']['title_id'])) {
    if (strpos($filters['issues']['title_id'], ',') > -1) {
      $titleIds = explode(',', $filters['issues']['title_id']);
      $issueFilters[] = "(titles.id = '" . implode("' OR titles.id = '", $titleIds) . "')";
    } else {
      $issueFilters[] = "titles.id = '" . $filters['issues']['title_id'] . "'";
    }
  }

  if (!is_null($filters['issues']['year'])) {
    if (strpos($filters['issues']['year'], ',') > -1) {
      $year           = explode(',', $filters['issues']['year']);
      $issueFilters[] = "(year LIKE '%" . implode("' OR year LIKE '%", $year) . "')";
    } else {
      $issueFilters[] = "year LIKE '%" . $filters['issues']['year'] . "'";
    }
  }

  if (!is_null($filters['issues']['issueIds'])) {
    $issueIds       = count($filters['issues']['issueIds']) > 0 ? implode(',', $filters['issues']['issueIds']) : 'NULL';
    $issueFilters[] = "issues.id IN ({$issueIds})";
  }

  if (count($issueFilters) > 0) {
    $whereIssues = 'WHERE ' . implode(" {$delimiter} ", $issueFilters);
  }

  return $whereIssues;
}

function parseFilters() {
  $filters = [
    'contributors' => [],
    'issues'       => []
  ];

  $contributorKeys = [
    'cover',
    'creator',
    'creator_id',
    'creator_type',
    'creator_type_id',
    'interior',
    'writer'
  ];

  $issueKeys = [
    'format',
    'format_id',
    'is_color',
    'is_desc',
    'is_owned',
    'is_read',
    'notes',
    'number',
    'order_by',
    'publisher',
    'publisher_id',
    'title',
    'title_id',
    'year'
  ];

  foreach ($_REQUEST as $key => $value) {
    if (in_array($key, $contributorKeys)) {
      $filters['contributors'][$key] = $value;
    } elseif (in_array($key, $issueKeys)) {
      if (strpos($key, 'is_') > -1) {
        $filters['issues'][$key] = ($value === 'true');
      } else {
        $filters['issues'][$key] = $value;
      }
    }
  }

  if ($_REQUEST['any']) {
    $filters['contributors']['creator'] .= count($filters['contributors']['creator']) > 0 ? ',' . $_REQUEST['any'] : $_REQUEST['any'];
    $filters['issues']['notes']         .= count($filters['issues']['notes']) > 0         ? ',' . $_REQUEST['any'] : $_REQUEST['any'];
    $filters['issues']['publisher']     .= count($filters['issues']['publisher']) > 0     ? ',' . $_REQUEST['any'] : $_REQUEST['any'];
    $filters['issues']['title']         .= count($filters['issues']['title']) > 0         ? ',' . $_REQUEST['any'] : $_REQUEST['any'];
    $filters['delimiter'] = 'OR';
  } elseif ($_REQUEST['delimiter']) {
    $filters['delimiter'] = $_REQUEST['delimiter'];
  }

  if (count($filters['contributors']) > 0) {
    $filters['issues']['issueIds'] = [];
  }

  return $filters;
}
