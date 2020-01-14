<?php
if ($_COOKIE['user']) {
  $user = json_decode($_COOKIE['user']);
} else {
  $user = array(
    'isSignedIn' => false,
    'md5'        => null,
    'name'       => null
  );
}
