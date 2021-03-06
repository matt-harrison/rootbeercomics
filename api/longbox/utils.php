<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php');

function addCreator($creatorName) {
  if (!empty($creatorName)) {
    $query  = "INSERT INTO creators (name) VALUES ('{$creatorName}')";
    $result = execute($query, 'kittenb1_longbox');
    $rows   = select("SELECT id from creators ORDER BY id desc LIMIT 1", 'kittenb1_longbox');
    $id     = $rows[0]['id'];
  }

  return $id;
}

function addCreatorType($creatorTypeName) {
  if (!empty($creatorTypeName)) {
    $query  = "INSERT INTO creator_types (name) VALUES ('{$creatorTypeName}')";
    $result = execute($query, 'kittenb1_longbox');
    $rows   = select("SELECT id from creator_types ORDER BY id desc LIMIT 1", 'kittenb1_longbox');
    $id     = $rows[0]['id'];
  }

  return $id;
}

function addContributor($issueId, $creatorId, $creatorTypeId) {
  if (!empty($issueId) && !empty($creatorId) && !empty($creatorTypeId)) {
    $query  = "
    INSERT INTO contributors (
      issue_id,
      creator_id,
      creator_type_id
    ) VALUES (
      '{$issueId}',
      '{$creatorId}',
      '{$creatorTypeId}'
    )";
    $result = execute($query, 'kittenb1_longbox');
    $rows   = select("SELECT id from contributors ORDER BY id desc LIMIT 1", 'kittenb1_longbox');
    $id     = $rows[0]['id'];
  }

  return $id;
}

function addFormat($formatName) {
  if (!empty($formatName)) {
    $query  = "INSERT INTO formats (name) VALUES ('{$formatName}')";
    $result = execute($query, 'kittenb1_longbox');
    $rows   = select("SELECT id from formats ORDER BY id desc LIMIT 1", 'kittenb1_longbox');
    $id     = $rows[0]['id'];
  }

  return $id;
}

function addPublisher($publisherName) {
  if (!empty($publisherName)) {
    $query  = "INSERT INTO publishers (name) VALUES ('{$publisherName}')";
    $result = execute($query, 'kittenb1_longbox');
    $rows   = select("SELECT id from publishers ORDER BY id desc LIMIT 1", 'kittenb1_longbox');
    $id     = $rows[0]['id'];
  }

  return $id;
}

function addTitle($titleName) {
  if (!empty($titleName)) {
    $query  = "INSERT INTO titles (name) VALUES ('{$titleName}')";
    $result = execute($query, 'kittenb1_longbox');
    $rows   = select("SELECT id from titles ORDER BY id desc LIMIT 1", 'kittenb1_longbox');
    $id     = $rows[0]['id'];
  }

  return $id;
}

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
    'filters' => $filters['contributors'],
    'query'   => $query,
    'results' => $contributors
  ];
}

function getContributorId($issueId, $creatorId, $creatorTypeId) {
  $contributors = getContributors();

  foreach ($contributors['results'] as $contributor) {
    if ($contributor['issue_id'] === $issueId && $contributor['creator_id'] === $creatorId && $contributor['creator_type_id'] === $creatorTypeId) {
      $contributorId = $contributor['id'];
    }
  }

  if (is_null($contributorId)) {
    $contributorId = addContributor($issueId, $creatorId, $creatorTypeId);
  }

  return $contributorId;
}

function getCreatorId($creatorName) {
  $creators = getCreators();

  foreach ($creators['results'] as $creator) {
    if ($creator['name'] === $creatorName) {
      $creatorId = $creator['id'];
    }
  }

  if (is_null($creatorId)) {
    $creatorId = addCreator($creatorName);
  }

  return $creatorId;
}

function getCreators() {
  $filters = parseFilters();
  $where   = getWhere($filters);
  $query   = "SELECT * FROM creators" . $where;
  $results = select($query, 'kittenb1_longbox');

  return [
    'count'   => count($results),
    'filters' => $filters,
    'query'   => $query,
    'results' => $results
  ];
}

function getCreatorTypeId($creatorTypeName) {
  $creatorTypes = getCreatorTypes();

  foreach ($creatorTypes['results'] as $creatorType) {
    if ($creatorType['name'] === $creatorTypeName) {
      $creatorTypeId = $creatorType['id'];
    }
  }

  if (is_null($creatorTypeId)) {
    $creatorTypeId = addCreatorType($creatorTypeName);
  }

  return $creatorTypeId;
}

function getCreatorTypes() {
  $filters = parseFilters();
  $where   = getWhere($filters);
  $query   = "SELECT * FROM creator_types" . $where;
  $results = select($query, 'kittenb1_longbox');

  return [
    'count'   => count($results),
    'filters' => $filters,
    'query'   => $query,
    'results' => $results
  ];
}

function getFormatId($formatName) {
  $formats = getFormats();

  foreach ($formats['results'] as $format) {
    if ($format['name'] === $formatName) {
      $formatId = $format['id'];
    }
  }

  if (is_null($formatId)) {
    $formatId = addFormat($formatName);
  }

  return $formatId;
}

function getFormats() {
  $filters = parseFilters();
  $where   = getWhere($filters);
  $query   = "SELECT * FROM formats" . $where;
  $results = select($query, 'kittenb1_longbox');

  return [
    'count'   => count($results),
    'filters' => $filters,
    'query'   => $query,
    'results' => $results
  ];
}

function getIssueById($id) {
  $query =
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
      titles.sort_name AS sort_title,
      publishers.id AS publisher_id,
      publishers.name AS publisher,
      formats.id AS format_id,
      formats.name as format
    FROM issues
    LEFT JOIN titles ON title_id = titles.id
    LEFT JOIN publishers ON publisher_id = publishers.id
    LEFT JOIN formats ON format_id = formats.id
    WHERE id = {$id}";

  $issue        = select($query, 'kittenb1_longbox')[0];
  $contributors = getContributors();

  foreach ($contributors['results'] as $contributor) {
    if ($contributor['issue_id'] === $issue['id']) {
      $issue['contributors'][] = $contributor;
    }
  }

  return $issue;
}

function getIssues($filters = []) {
  $where   = getWhereIssues($filters);
  $isDesc  = is_null($filters['issues']['is_desc']) ? 'ASC' : 'DESC';
  $orderBy = is_null($filters['issues']['order_by']) ? '' : 'ORDER BY ' . $filters['issues']['order_by'] . ' ' . $isDesc;
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
      titles.sort_name AS sort_title,
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
    'filters' => $filters['issues'],
    'query'   => $query,
    'results' => $issues
  ];
}

function getIssuesWithContributors() {
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

function getPublisherId($publisherName) {
  $publishers = getPublishers();

  foreach ($publishers['results'] as $publisher) {
    if ($publisher['name'] === $publisherName) {
      $publisherId = $publisher['id'];
    }
  }

  if (is_null($publisherId)) {
    $publisherId = addPublisher($publisherName);
  }

  return $publisherId;
}

function getPublishers() {
  $filters = parseFilters();
  $where   = getWhere($filters);
  $query   = "SELECT * FROM publishers" . $where;
  $results = select($query, 'kittenb1_longbox');

  return [
    'count'   => count($results),
    'filters' => $filters['results'],
    'query'   => $query,
    'results' => $results
  ];
}

function getTitleId($titleName) {
  $titles = getTitles();

  foreach ($titles['results'] as $title) {
    if ($title['name'] === $titleName) {
      $titleId = $title['id'];
    }
  }

  if (is_null($titleId)) {
    $titleId = addTitle($titleName);
  }

  return $titleId;
}

function getTitles() {
  $filters = parseFilters();
  $where   = getWhere($filters);
  $query   = "SELECT * FROM titles" . $where;
  $results = select($query, 'kittenb1_longbox');

  return [
    'count'   => count($results),
    'filters' => $filters['results'],
    'query'   => $query,
    'results' => $results
  ];
}

function getWhere($filters = []) {
  $delimiter       = is_null($filters['delimiter']) ? 'AND' : $filters['delimiter'];
  $sortOrder       = empty($filters['issues']['is_desc']) ? ' ASC' : ' DESC';
  $orderBy         = empty($filters['issues']['order_by']) ? '' : ' ORDER BY ' . $filters['issues']['order_by'] . $sortOrder;
  $whereClause     = '';
  $whereConditions = [];

  if (!empty($filters['id'])) {
    $whereConditions[] = 'id = "' . $filters['id'] . '"';
  }

  if (!empty($filters['name'])) {
    $whereConditions[] = 'name LIKE "%' . $filters['name'] . '%"';
  }

  if (count($whereConditions) > 0) {
    $whereClause = ' WHERE ' . implode(" {$delimiter} ", $whereConditions);
  }

  $whereClause .= $orderBy;

  return $whereClause;
}

function getWhereContributors($filters = []) {
  $delimiter       = is_null($filters['delimiter']) ? 'AND' : $filters['delimiter'];
  $whereClause     = '';
  $whereConditions = [];

  // Foreign Key filters
  if (!is_null($filters['contributors']['creator'])) {
    if (strpos($filters['contributors']['creator'], ',') > -1) {
      $creators          = explode(',', $filters['contributors']['creator']);
      $whereConditions[] = "(creators.name LIKE '%" . implode("%' OR creators.name LIKE '%", $creators) . "%')";
    } else {
      $whereConditions[] = "creators.name LIKE '%" . $filters['contributors']['creator'] . "%'";
    }
  }

  if (!is_null($filters['contributors']['creator_type'])) {
    if (strpos($filters['contributors']['creator_type'], ',') > -1) {
      $creatorTypes      = explode(',', $filters['contributors']['creator_type']);
      $whereConditions[] = "(creator_types.name = '" . implode("' OR creator_types.name = '", $creatorTypes) . "')";
    } else {
      $whereConditions[] = "creator_types.name = '" . $filters['contributors']['creator_type'] . "'";
    }
  }

  // ID filters
  if (!is_null($filters['contributors']['creator_id'])) {
    if (strpos($filters['contributors']['creator_id'], ',') > -1) {
      $creatorIds        = explode(',', $filters['contributors']['creator_id']);
      $whereConditions[] = "(creators.id = '" . implode("' OR creators.id = '", $creatorIds) . "')";
    } else {
      $whereConditions[] = "creators.id = '" . $filters['contributors']['creator_id'] . "'";
    }
  }

  if (!is_null($filters['contributors']['creator_type_id'])) {
    if (strpos($filters['contributors']['creator_type_id'], ',') > -1) {
      $creatorTypeIds    = explode(',', $filters['contributors']['creator_type_id']);
      $whereConditions[] = "(creator_types.id = '" . implode("' OR creator_types.id = '", $creatorTypeIds) . "')";
    } else {
      $whereConditions[] = "creator_types.id = '" . $filters['contributors']['creator_type_id'] . "'";
    }
  }

  // Custom filters (alaso based on Foreign Keys)
  if (!is_null($filters['contributors']['cover'])) {
    if (strpos($filters['contributors']['cover'], ',') > -1) {
      $creators          = explode(',', $filters['contributors']['cover']);
      $whereConditions[] = "creator_types.name = 'cover' AND (creators.name LIKE '%" . implode("' OR creators.name LIKE '%", $creators) . "%')";
    } else {
      $whereConditions[] = "(creator_types.name = 'cover' AND creators.name LIKE '%" . $filters['contributors']['cover'] . "%')";
    }
  }

  if (!is_null($filters['contributors']['writer'])) {
    if (strpos($filters['contributors']['writer'], ',') > -1) {
      $creatorTypeIds    = explode(',', $filters['contributors']['writer']);
      $whereConditions[] = "creator_types.name = 'writer' AND (creators.name LIKE '%" . implode("' OR creators.name LIKE '%", $creatorTypeIds) . "%')";
    } else {
      $whereConditions[] = "(creator_types.name = 'writer' AND creators.name LIKE '%" . $filters['contributors']['writer'] . "%')";
    }
  }

  if (!is_null($filters['contributors']['interior'])) {
    if (strpos($filters['contributors']['interior'], ',') > -1) {
      $creators          = explode(',', $filters['contributors']['interior']);
      $whereConditions[] = "creator_types.name = 'interior' AND (creators.name LIKE '%" . implode("' OR creators.name LIKE '%", $creators) . "%')";
    } else {
      $whereConditions[] = "(creator_types.name = 'interior' AND creators.name LIKE '%" . $filters['contributors']['interior'] . "%')";
    }
  }

  if (count($whereConditions) > 0) {
    $whereClause = 'WHERE ' . implode(" {$delimiter} ", $whereConditions);
  }

  return $whereClause;
}

function getWhereIssues($filters = []) {
  $delimiter       = is_null($filters['delimiter']) ? 'AND' : $filters['delimiter'];
  $whereClause     = '';
  $whereConditions = [];

  // Foreign Key filters
  if (!is_null($filters['issues']['format'])) {
    if (strpos($filters['issues']['format'], ',') > -1) {
      $formats           = explode(',', $filters['issues']['format']);
      $whereConditions[] = "(formats.name = '" . implode("' OR formats.name = '", $formats) . "')";
    } else {
      $whereConditions[] = "formats.name = '" . $filters['issues']['format'] . "'";
    }
  }

  if (!is_null($filters['issues']['publisher'])) {
    if (strpos($filters['issues']['publisher'], '|') > -1) {
      $publisher         = explode('|', $filters['issues']['publisher']);
      $whereConditions[] = "(publishers.name LIKE '%" . implode("%' OR publishers.name LIKE '%", $publisher) . "%')";
    } else {
      $whereConditions[] = "publishers.name LIKE '%" . $filters['issues']['publisher'] . "%'";
    }
  }

  if (!is_null($filters['issues']['title'])) {
    if (strpos($filters['issues']['title'], '|') > -1) {
      $title             = explode('|', $filters['issues']['title']);
      $whereConditions[] = "(titles.name LIKE '%" . implode("%' OR titles.name LIKE '%", $title) . "%')";
    } else {
      $whereConditions[] = "titles.name LIKE '%" . $filters['issues']['title'] . "%'";
    }
  }

  // ID filters
  if (!is_null($filters['issues']['format_id'])) {
    if (strpos($filters['issues']['format_id'], '|') > -1) {
      $formatIds         = explode('|', $filters['issues']['format_id']);
      $whereConditions[] = "(formats.id = '" . implode("' OR formats.id = '", $formatIds) . "')";
    } else {
      $whereConditions[] = "formats.id = '" . $filters['issues']['format_id'] . "'";
    }
  }

  if (!is_null($filters['issues']['issue_id'])) {
    if (strpos($filters['issues']['issue_id'], ',') > -1) {
      $issueIds          = explode(',', $filters['issues']['issue_id']);
      $whereConditions[] = "(issues.id = '" . implode("' OR issues.id = '", $issueIds) . "')";
    } else {
      $whereConditions[] = "issues.id = '" . $filters['issues']['issue_id'] . "'";
    }
  }

  if (!is_null($filters['issues']['publisher_id'])) {
    if (strpos($filters['issues']['publisher_id'], ',') > -1) {
      $publisherIds      = explode(',', $filters['issues']['publisher_id']);
      $whereConditions[] = "(publishers.id = '" . implode("' OR publishers.id = '", $publisherIds) . "')";
    } else {
      $whereConditions[] = "publishers.id = '" . $filters['issues']['publisher_id'] . "'";
    }
  }

  if (!is_null($filters['issues']['title_id'])) {
    if (strpos($filters['issues']['title_id'], ',') > -1) {
      $titleIds          = explode(',', $filters['issues']['title_id']);
      $whereConditions[] = "(titles.id = '" . implode("' OR titles.id = '", $titleIds) . "')";
    } else {
      $whereConditions[] = "titles.id = '" . $filters['issues']['title_id'] . "'";
    }
  }

  // Boolean filters
  if ($filters['issues']['is_color'] === 'null') {
    $whereConditions[] = "is_color IS NULL";
  } elseif (!is_null($filters['issues']['is_color'])) {
    $whereConditions[] = "is_color = '" . $filters['issues']['is_color'] . "'";
  }

  if ($filters['issues']['is_owned'] === 'null') {
    $whereConditions[] = "is_owned IS NULL";
  } elseif (!is_null($filters['issues']['is_owned'])) {
    $whereConditions[] = "is_owned = '" . $filters['issues']['is_owned'] . "'";
  }

  if ($filters['issues']['is_read'] === 'null') {
    $whereConditions[] = "is_read IS NULL";
  } elseif (!is_null($filters['issues']['is_read'])) {
    $whereConditions[] = "is_read = '" . $filters['issues']['is_read'] . "'";
  }

  // String/Number filters
  if (!is_null($filters['issues']['number'])) {
    if (strpos($filters['issues']['number'], ',') > -1) {
      $numbers           = explode(',', $filters['issues']['number']);
      $whereConditions[] = "(number = " . implode(' OR number = ', $numbers) . ")";
    } else {
      $whereConditions[] = "number = '" . $filters['issues']['number'] . "'";
    }
  }

  if (!is_null($filters['issues']['notes'])) {
    if (strpos($filters['issues']['notes'], ',') > -1) {
      $notes             = explode(',', $filters['issues']['notes']);
      $whereConditions[] = "(notes LIKE '%" . implode("%' OR notes LIKE '", $notes) . "%')";
    } else {
      $whereConditions[] = "notes LIKE '%" . $filters['issues']['notes'] . "%'";
    }
  }

  if (!is_null($filters['issues']['year'])) {
    if (strpos($filters['issues']['year'], ',') > -1) {
      $year              = explode(',', $filters['issues']['year']);
      $whereConditions[] = "(year LIKE '%" . implode("' OR year LIKE '%", $year) . "')";
    } else {
      $whereConditions[] = "year LIKE '%" . $filters['issues']['year'] . "'";
    }
  }

  // Filter by any Issue IDs identified by Contributor query
  if (!is_null($filters['issues']['issueIds'])) {
    $issueIds       = count($filters['issues']['issueIds']) > 0 ? implode(',', $filters['issues']['issueIds']) : 'NULL';
    $whereConditions[] = "issues.id IN ({$issueIds})";
  }

  if (count($whereConditions) > 0) {
    $whereClause = 'WHERE ' . implode(" {$delimiter} ", $whereConditions);
  }

  return $whereClause;
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
    'issue_id',
    'notes',
    'number',
    'order_by',
    'publisher',
    'publisher_id',
    'title',
    'title_id',
    'year'
  ];

  $con = getConnection('kittenb1_longbox');

  foreach ($_REQUEST as $key => $value) {
    if (strpos($key, 'is_') > -1) {
      if ($value === 'null') {
        $value = 'null';
      } else {
        $value = ($value === 'true' || $value == '1');
      }
    } else {
      $value = mysqli_real_escape_string($con, $value);
    }

    if (in_array($key, $contributorKeys)) {
      $filters['contributors'][$key] = $value;
    } elseif (in_array($key, $issueKeys)) {
      $filters['issues'][$key] = $value;
    } elseif ($key === 'any') {
      $value = mysqli_real_escape_string($con, $_REQUEST['any']);

      $filters['contributors']['creator'] .= count($filters['contributors']['creator']) > 0 ? ',' . $value : $value;
      $filters['issues']['notes']         .= count($filters['issues']['notes']) > 0         ? ',' . $value : $value;
      $filters['issues']['publisher']     .= count($filters['issues']['publisher']) > 0     ? ',' . $value : $value;
      $filters['issues']['title']         .= count($filters['issues']['title']) > 0         ? ',' . $value : $value;
      $filters['delimiter'] = 'OR';
    } else {
      $filters[$key] = $value;
    }
  }

  if (count($filters['contributors']) > 0) {
    $filters['issues']['issueIds'] = [];
  }

  return $filters;
}
