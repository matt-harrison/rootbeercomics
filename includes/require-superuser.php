<?php
if (!$user->isAdmin) {
  header('Location: /');
}
