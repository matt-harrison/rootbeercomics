<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php');

$response        = [];
$includeArticles = $_REQUEST['includeArticles'];

if ($includeArticles) {
  $query = "
    SELECT
      articles.id,
      articles.name,
      articles.count,
      articles.type_id,
      articles.thumb,
      articles.size,
      articles.hex,
      article_types.id AS article_type_id,
      article_types.is_top AS is_top,
      article_types.is_bottom AS is_bottom
    FROM articles
    LEFT JOIN article_types ON articles.type_id = article_types.id";

  $results = select($query, 'kittenb1_wardrobe');
  $response['articles'] = [
    'count'   => count($results),
    'query'   => $query,
    'results' => $results
  ];
}

$query =
  "SELECT
    outfits.id AS id,
    outfits.date,
    outfits.top_id,
    outfits.bottom_id,
    outfits.to_wash_top,
    outfits.to_wash_bottom,
    top.id AS top_id,
    top.name AS top_name,
    top.count AS top_count,
    top.type_id AS top_type_id,
    top.thumb AS top_thumb,
    top.size AS top_size,
    top.hex AS top_hex,
    bottom.id AS bottom_id,
    bottom.name AS bottom_name,
    bottom.count AS bottom_count,
    bottom.type_id AS bottom_type_id,
    bottom.thumb AS bottom_thumb,
    bottom.size AS bottom_size,
    bottom.hex AS bottom_hex
  FROM outfits
  LEFT JOIN articles AS top ON outfits.top_id = top.id
  LEFT JOIN articles AS bottom ON outfits.bottom_id = bottom.id
  ORDER BY date asc";

$results  = select($query, 'kittenb1_wardrobe');
$response['outfits'] = [
  'count'   => count($results),
  'query'   => $query,
  'results' => $results
];

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
echo json_encode($response);
