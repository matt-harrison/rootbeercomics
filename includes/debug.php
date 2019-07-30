<?php
function debug($subject, $indention = 0) {
  if ($indention === 0) {
    echo '<pre>';
  }

  switch (gettype($subject)) {
    case 'array':
    case 'object':
      if ($indention > 0) {
        echo '<br/>';
      }

      foreach ($subject as $key => $value) {
        echo str_repeat('  ', $indention) . $key . ': ';
        debug($value, $indention + 1);
      }
      break;
    case 'NULL':
      echo 'NULL<br/>';
      break;
    case 'boolean':
      echo (($subject) ? 'TRUE' : 'FALSE') . '<br/>';
      break;
    case 'double':
    case 'integer':
    case 'string':
      echo $subject . '<br/>';
      break;
  }

  if ($indention === 0) {
    echo '</pre>';
  }
}

// Include in active dev files:
// include($_SERVER['DOCUMENT_ROOT'] . '/includes/debug.php');
