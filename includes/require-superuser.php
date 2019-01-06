<?php
if ($_COOKIE['username'] !== 'matt!') {
    header('Location: /');
}
