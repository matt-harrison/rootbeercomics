<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/debug.php');

if (!$user->isAdmin) {
  header('Location: /');
}
