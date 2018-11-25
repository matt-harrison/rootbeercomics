<?php
function saveCookie($name, $value = '', $interval = 0) {
  $expire = time() + $interval;
  setcookie($name, $value, $expire, '/');
}
