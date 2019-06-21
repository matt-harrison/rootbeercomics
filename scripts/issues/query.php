<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

function getData() {
  $color     = $_REQUEST['color'];
  $creator   = $_REQUEST['creator'];
  $format    = $_REQUEST['format'];
  $number    = $_REQUEST['number'];
  $own       = $_REQUEST['own'];
  $publisher = $_REQUEST['publisher'];
  $read      = $_REQUEST['read'];
  $title     = $_REQUEST['title'];
  $type      = $_REQUEST['type'];
  $year      = $_REQUEST['year'];

  $contributorsIds           = [];
  $filtersContributor        = [];
  $filtersIssue              = [];
  $issuesWithContributorsIds = [];
  $whereContributors         = '';
  $whereIssues               = '';

  if (!is_null($creator)) {
    $filtersContributor[] = "creators.name LIKE '%{$creator}%'";
  }

  if (!is_null($type)) {
    $filtersContributor[] = "creator_types.name LIKE '%{$type}%'";
  }

  if (count($filtersContributor) > 0) {
    $whereContributors = 'WHERE ' . implode(' AND ', $filtersContributor);
    $contributorsFilteredQuery =
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
      {$whereContributors}";

    $contributorsFiltered = select($contributorsFilteredQuery, 'kittenb1_issues');

    if (count($filtersContributor) > 0) {
      foreach ($contributorsFiltered as $contributor) {
        if (!in_array($contributor['issue_id'], $issuesWithContributorsIds)) {
          $issuesWithContributorsIds[] = $contributor['issue_id'];
        }
      }

      if (count($issuesWithContributorsIds) > 0) {
        $filteredIssueIds = implode(',', $issuesWithContributorsIds);
        $filtersIssue[] = "issues.id IN ({$filteredIssueIds})";
      }
    }
  }

  if (!is_null($format)) {
    $filtersIssue[] = "formats.name = '{$format}'";
  }

  if (!is_null($publisher)) {
    $filtersIssue[] = "publishers.name LIKE '%{$publisher}%'";
  }

  if (!is_null($title)) {
    $filtersIssue[] = "titles.name LIKE '%{$title}%'";
  }

  if (!is_null($color)) {
    $filtersIssue[] = "is_color = '{$color}'";
  }

  if (!is_null($number)) {
    $filtersIssue[] = "number = '{$number}'";
  }

  if (!is_null($own)) {
    $filtersIssue[] = "is_owned = '{$own}'";
  }

  if (!is_null($read)) {
    $filtersIssue[] = "is_read = '{$read}'";
  }

  if (!is_null($year)) {
    $filtersIssue[] = "year = '{$year}'";
  }

  if (count($filtersIssue) > 0) {
    $whereIssues = 'WHERE ' . implode(' AND ', $filtersIssue);
  }

  $issuesQuery =
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
    {$whereIssues}";

  $issues = select($issuesQuery, 'kittenb1_issues');

  if (count($filtersContributor) < 1) {
    $contributorsAllQuery =
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
      LEFT JOIN creator_types ON contributors.creator_type_id = creator_types.id";

    $contributorsAll = select($contributorsAllQuery, 'kittenb1_issues');
  }

  $contributors = (count($filtersContributor) > 0) ? $contributorsFiltered : $contributorsAll;

  foreach ($issues as $index => $issue) {
    foreach ($contributors as $contributor) {
      if ($contributor['issue_id'] === $issue['id']) {
        $issues[$index]['contributors'][] = $contributor;
      }
    }
  }

  $response = [
    'success' => !($issues === 'FALSE') && !($contributors === 'FALSE'),
    'contributors' => [
      'count'   => count($contributors),
      'filters' => [],
      'query'   => (count($filtersContributor) > 0) ? $contributorsFilteredQuery : $contributorsAllQuery,
      'results' => $contributors
    ],
    'issues' => [
      'count'   => count($issues),
      'filters' => [],
      'query'   => $issuesQuery,
      'results' => $issues
    ]
  ];

  return $response;
}
