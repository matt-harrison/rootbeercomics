<?php
function escapeSpecialCharacters($input) {
  $output = $input;
  $output = str_replace("'", '\&apos;', $output);
  $output = str_replace('"', "\&quot;", $output);

  return $output;
}
