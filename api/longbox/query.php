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
  if (count($filters['contributors']) > 0 || !is_null($filters['any'])) {
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

  if (!is_null($filters['contributors']['creator']) && !is_null($filters['any'])) {
    $contributorFilters[] = "(creators.name LIKE '%" . $filters['contributors']['creator'] . "%' OR creators.name LIKE '%" . $filters['any'] . "%')";
  } elseif (!is_null($filters['contributors']['cover'])) {
    $contributorFilters[] = "creator_types.name = 'cover' AND creators.name LIKE '%" . $filters['contributors']['cover'] . "%'";
  } elseif (!is_null($filters['contributors']['writer'])) {
    $contributorFilters[] = "creator_types.name = 'writer' AND creators.name LIKE '%" . $filters['contributors']['writer'] . "%'";
  } elseif (!is_null($filters['contributors']['interior'])) {
    $contributorFilters[] = "creator_types.name = 'interior' AND creators.name LIKE '%" . $filters['contributors']['interior'] . "%'";
  } elseif (!is_null($filters['contributors']['creator'])) {
    $contributorFilters[] = "creators.name LIKE '%" . $filters['contributors']['creator'] . "%'";
  } elseif (!is_null($filters['any'])) {
    $contributorFilters[] = "creators.name LIKE '%" . $filters['any'] . "%'";
  }

  if (!is_null($filters['contributors']['creator_id'])) {
    $contributorFilters[] = "creators.id = '" . $filters['contributors']['creator_id'] . "'";
  }

  if (!is_null($filters['contributors']['creator_type'])) {
    $contributorFilters[] = "creator_types.name = '" . $filters['contributors']['creator_type'] . "'";
  }

  if (!is_null($filters['contributors']['creator_type_id'])) {
    $contributorFilters[] = "creator_types.id = '" . $filters['contributors']['creator_type_id'] . "'";
  }

  if (count($contributorFilters) > 0) {
    $whereContributors = 'WHERE ' . implode(" {$delimiter} ", $contributorFilters);
  }

  return $whereContributors;
}

function getWhereIssues($filters = []) {
  $delimiter    = is_null($filters['delimiter']) ? 'AND' : " {$filters['delimiter']} ";
  $whereIssues  = '';
  $issueFilters = [];

  if (!is_null($filters['issues']['format'])) {
    $issueFilters[] = "formats.name = '" . $filters['issues']['format'] . "'";
  }

  if (!is_null($filters['issues']['format_id'])) {
    $issueFilters[] = "formats.id = '" . $filters['issues']['format_id'] . "'";
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
    $issueFilters[] = "number = '" . $filters['issues']['number'] . "'";
  }

  if (!is_null($filters['issues']['notes']) && !is_null($filters['any'])) {
    $issueFilters[] = "(notes LIKE '%" . $filters['issues']['notes'] . "%' OR notes LIKE '%" . $filters['any'] . "%')";
  } elseif (!is_null($filters['issues']['notes'])) {
    $issueFilters[] = "notes LIKE '%" . $filters['issues']['notes'] . "%'";
  } elseif (!is_null($filters['any'])) {
    $issueFilters[] = "notes LIKE '%" . $filters['any'] . "%'";
  }

  if (!is_null($filters['issues']['publisher']) && !is_null($filters['any'])) {
    $issueFilters[] = "(publishers.name LIKE '%" . $filters['issues']['publisher'] . "%' OR publishers.name LIKE '%" . $filters['any'] . "%')";
  } elseif (!is_null($filters['issues']['publisher'])) {
    $issueFilters[] = "publishers.name LIKE '%" . $filters['issues']['publisher'] . "%'";
  } elseif (!is_null($filters['any'])) {
    $issueFilters[] = "publishers.name LIKE '%" . $filters['any'] . "%'";
  }

  if (!is_null($filters['issues']['publisher_id'])) {
    $issueFilters[] = "publishers.id LIKE '%" . $filters['issues']['publisher_id'] . "%'";
  }

  if (!is_null($filters['issues']['title']) && !is_null($filters['any'])) {
    $issueFilters[] = "(titles.name LIKE '%" . $filters['issues']['title'] . "%' OR titles.name LIKE '%" . $filters['any'] . "%')";
  } elseif (!is_null($filters['issues']['title'])) {
    $issueFilters[] = "titles.name LIKE '%" . $filters['issues']['title'] . "%'";
  } elseif (!is_null($filters['any'])) {
    $issueFilters[] = "titles.name LIKE '%" . $filters['any'] . "%'";
  }

  if (!is_null($filters['issues']['title_id'])) {
    $issueFilters[] = "titles.id LIKE '%" . $filters['issues']['title_id'] . "%'";
  }

  if (!is_null($filters['issues']['year'])) {
    $issueFilters[] = "year LIKE '%" . $filters['issues']['year'] . "'";
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

  if ($_REQUEST['any']) {
    $filters['any']       = $_REQUEST['any'];
    $filters['delimiter'] = 'OR';
  } elseif ($_REQUEST['delimiter']) {
    $filters['delimiter'] = $_REQUEST['delimiter'];
  }

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

  if (count($filters['contributors']) > 0 || !is_null($filters['any'])) {
    $filters['issues']['issueIds'] = [];
  }

  return $filters;
}
