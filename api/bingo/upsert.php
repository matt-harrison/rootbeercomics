<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// debug($_REQUEST);
// die();

include($_SERVER['DOCUMENT_ROOT'] . '/includes/utils.php');

$free       = $_REQUEST['free'];
$heading    = $_REQUEST['heading'];
$id         = $_REQUEST['id'];
$label      = $_REQUEST['label'] ? escapeSpecialCharacters($_REQUEST['label']) : null;
$slug       = $_REQUEST['slug'];
$squares    = $_REQUEST['squares'] ? json_decode($_REQUEST['squares']) : [];

$boards     = [];
$errors     = [];
$operations = [];

if (is_null($label)) {
  array_push($errors, 'Please specify a valid label.');
} else if (is_null($id)) {
  $boardsByLabel = select("SELECT * from boards WHERE label = '$label'", 'kittenb1_bingo');

  if (count($boardsByLabel) > 0) {
    array_push($errors, 'The requested label already exists.');
  }
}

if (is_null($slug)) {
  array_push($errors, 'Please specify a valid slug (URL page name).');
} else if (is_null($id)) {
  $boardsBySlug = select("SELECT * from boards WHERE slug = '$slug'", 'kittenb1_bingo');

  if (count($boardsBySlug) > 0) {
    array_push($errors, 'The requested slug already exists.');
  }
}

$success = count($errors) === 0;

if ($success) {
  $query = is_null($id) ? "
    INSERT INTO boards (
      free,
      heading,
      label,
      slug
    ) VALUES (
      '{$free}',
      '{$heading}',
      '{$label}',
      '{$slug}'
    )
  " : "
    UPDATE boards
    SET
      free    = '{$free}',
      heading = '{$heading}',
      label   = '{$label}',
      slug    = '{$slug}'
    WHERE id = {$id}
  ";

  $success    = execute($query, 'kittenb1_bingo');
  $square->id = $boards['id'];

  array_push($operations, [
    'query'   => $query,
    'success' => $success
  ]);

  forEach ($squares as $square) {
    $id    = $square->id;
    $label = escapeSpecialCharacters($square->label);

    if ($label === '' && !is_null($id)) {
      $query   = "DELETE FROM squares WHERE id = {$id}";
      $success = execute($query, 'kittenb1_bingo');
    } else {
      $query = is_null($id) ? "
        INSERT INTO squares (
          board,
          label
        ) VALUES (
          '{$slug}',
          '{$label}'
        )
      " : "
        UPDATE squares
        SET
          board = '{$slug}',
          label = '{$label}'
        WHERE id = {$id}
      ";
      $success  = execute($query, 'kittenb1_bingo');
    }

    array_push($operations, [
      'query'   => $query,
      'success' => $success
    ]);
  }

  $squares          = select("SELECT * from squares WHERE board = '$slug' ORDER BY label ASC", 'kittenb1_bingo');
  $board['squares'] = $squares;

  $success = true;

  forEach ($operations as $operation) {
    if (!$operation['success']) {
      $success = false;
    }
  }
}

$response = [
  'data'       => $boards,
  'errors'     => $errors,
  'operations' => $operations,
  'success'    => $success
];

echo json_encode($response);
