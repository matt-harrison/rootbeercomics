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

  $contributors = select($query, 'kittenb1_issues');

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
  $contributorsAll      = getContributors();
  $contributors         = (count($filters['contributors']) > 0) ? $contributorsFiltered : $contributorsAll;

  $issues = getIssues($filters, $contributorsFiltered['results']);

  foreach ($issues['results'] as $index => $issue) {
    foreach ($contributors['results'] as $contributor) {
      if ($contributor['issue_id'] === $issue['id']) {
        $issues['results'][$index]['contributors'][] = $contributor;
      }
    }
  }

  $response = [
    'success'      => !($issues['results'] === 'FALSE') && !($contributors['results'] === 'FALSE'),
    'contributors' => $contributors,
    'issues'       => $issues
  ];

  return $response;
}

function getIssues($filters = [], $contributors) {

  if (count($filters['contributors']) > 0) {
    $filters['issues']['creatorMatches'] = [];

    foreach ($contributors as $contributor) {
      if (!in_array($contributor['issue_id'], $filters['issues']['creatorMatches'])) {
        $filters['issues']['creatorMatches'][] = $contributor['issue_id'];
      }
    }
  }

  $where = getWhereIssues($filters['issues']);
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
      publishers.id AS publisher_id,
      publishers.name AS publisher,
      formats.id AS format_id,
      formats.name as format
    FROM issues
    LEFT JOIN titles ON title_id = titles.id
    LEFT JOIN publishers ON publisher_id = publishers.id
    LEFT JOIN formats ON format_id = formats.id
    {$where}";

  $issues = select($query, 'kittenb1_issues');

  return [
    'count'   => count($issues),
    'filters' => $filters,
    'query'   => $query,
    'results' => $issues
  ];
}

function getWhereContributors($filters = []) {
  $whereContributors  = '';
  $contributorFilters = [];

  //programmatically set filters by iterating over properties of contributors?

  if (!is_null($filters['contributors']['creator'])) {
    $contributorFilters[] = "creators.name LIKE '%" . $filters['contributors']['creator'] . "%'";
  }

  if (!is_null($filters['contributors']['creator_id'])) {
    $contributorFilters[] = "creators.id LIKE '%" . $filters['contributors']['creator_id'] . "%'";
  }

  if (!is_null($filters['contributors']['creator_type'])) {
    $contributorFilters[] = "creator_types.name LIKE '%" . $filters['contributors']['creator_type'] . "%'";
  }

  if (!is_null($filters['contributors']['creator_type_id'])) {
    $contributorFilters[] = "creator_types.id LIKE '%" . $filters['contributors']['creator_type_id'] . "%'";
  }

  if (count($contributorFilters) > 0) {
    $whereContributors = 'WHERE ' . implode(' AND ', $contributorFilters);
  }

  return $whereContributors;
}

function getWhereIssues($filters = []) {
  $whereIssues  = '';
  $issueFilters = [];

  //programmatically set filters by iterating over properties of issues?

  if (!is_null($filters['format'])) {
    $issueFilters[] = "formats.name = '" . $filters['format'] . "'";
  }

  if (!is_null($filters['format_id'])) {
    $issueFilters[] = "formats.id = '" . $filters['format_id'] . "'";
  }

  if (!is_null($filters['color'])) {
    $issueFilters[] = "is_color = '" . $filters['is_color'] . "'";
  }

  if (!is_null($filters['own'])) {
    $issueFilters[] = "is_owned = '" . $filters['is_owned'] . "'";
  }

  if (!is_null($filters['read'])) {
    $issueFilters[] = "is_read = '" . $filters['is_read'] . "'";
  }

  if (!is_null($filters['number'])) {
    $issueFilters[] = "number = '" . $filters['number'] . "'";
  }

  if (!is_null($filters['publisher'])) {
    $issueFilters[] = "publishers.name LIKE '%" . $filters['publisher'] . "%'";
  }

  if (!is_null($filters['publisher_id'])) {
    $issueFilters[] = "publishers.id LIKE '%" . $filters['publisher_id'] . "%'";
  }

  if (!is_null($filters['title'])) {
    $issueFilters[] = "titles.name LIKE '%" . $filters['title'] . "%'";
  }

  if (!is_null($filters['title_id'])) {
    $issueFilters[] = "titles.id LIKE '%" . $filters['title_id'] . "%'";
  }

  if (!is_null($filters['year'])) {
    $issueFilters[] = "year LIKE '%" . $filters['year'] . "'";
  }

  if (count($filters['creatorMatches']) > 0) {
    $filteredIssueIds = implode(',', $filters['creatorMatches']);
    $issueFilters[] = "issues.id IN ({$filteredIssueIds})";
  }

  if (count($issueFilters) > 0) {
    $whereIssues = 'WHERE ' . implode(' AND ', $issueFilters);
  }

  return $whereIssues;
}

function parseFilters() {
  $filters = [
    'contributors' => [],
    'issues'       => []
  ];

  if ($_REQUEST['creator']) {
    $filters['contributors']['creator'] = $_REQUEST['creator'];
  }

  if ($_REQUEST['creator_id']) {
    $filters['contributors']['creator_id'] = $_REQUEST['creator_id'];
  }

  if ($_REQUEST['creator_type']) {
    $filters['contributors']['creator_type'] = $_REQUEST['creator_type'];
  }

  if ($_REQUEST['creator_type_id']) {
    $filters['contributors']['creator_type_id'] = $_REQUEST['creator_type_id'];
  }

  if ($_REQUEST['format']) {
    $filters['issues']['format'] = $_REQUEST['format'];
  }

  if ($_REQUEST['format_id']) {
    $filters['issues']['format_id'] = $_REQUEST['format_id'];
  }

  if ($_REQUEST['is_color']) {
    $filters['issues']['is_color'] = $_REQUEST['is_color'];
  }

  if ($_REQUEST['is_owned']) {
    $filters['issues']['is_owned'] = $_REQUEST['is_owned'];
  }

  if ($_REQUEST['is_read']) {
    $filters['issues']['is_read'] = $_REQUEST['is_read'];
  }

  if ($_REQUEST['number']) {
    $filters['issues']['number'] = $_REQUEST['number'];
  }

  if ($_REQUEST['publisher']) {
    $filters['issues']['publisher'] = $_REQUEST['publisher'];
  }

  if ($_REQUEST['publisher_id']) {
    $filters['issues']['publisher_id'] = $_REQUEST['publisher_id'];
  }

  if ($_REQUEST['title']) {
    $filters['issues']['title'] = $_REQUEST['title'];
  }

  if ($_REQUEST['title_id']) {
    $filters['issues']['title_id'] = $_REQUEST['title_id'];
  }

  if ($_REQUEST['year']) {
    $filters['issues']['year'] = $_REQUEST['year'];
  }

  return $filters;
}
