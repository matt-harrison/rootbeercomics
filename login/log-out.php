<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/cookies.php');
saveCookie('username', '');
header('Location: index.php');
