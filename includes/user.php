<?php
if ($_COOKIE['user']) {
  $user = json_decode($_COOKIE['user']);
} else {
  $user = array(
    'isAdmin'    => false,
    'isSignedIn' => false,
    'md5'        => null,
    'name'       => null
  );
}
