<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/debug.php');
debug($user);
if (!$user->isAdmin) {
  //header('Location: /');
}
