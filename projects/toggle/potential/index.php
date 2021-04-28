<?php
$title = 'Potential';
$desc  = 'Click to compare each of the original Potential pages with its revision.';
$width = 800;
$pages = array(
  array(
    '/minicomics/potential/img/potential1.jpg',
    '/minicomics/potential/draft2/img/potential1.jpg'
    '/minicomics/potential/draft1/img/potential1.jpg',
  ),
  array(
    '/minicomics/potential/img/potential2.jpg',
    '/minicomics/potential/draft2/img/potential2.jpg',
    '/minicomics/potential/draft1/img/potential2.jpg'
  )
);

include($_SERVER['DOCUMENT_ROOT'] . '/projects/toggle/index.php');
