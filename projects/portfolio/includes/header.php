<?php
if (empty($title)) {
    $title = $section;
}
?>
<!doctype html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1"/>
        <title><?= $title; ?> by Matt Harrison</title>
        <link href="/projects/portfolio/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="page" class="auto mt10 mb10 bdrBlack bgWhite">
            <div id="header" class="flex spaceBetween mb20">
                <a href="/projects/portfolio">
                    <img src="/projects/portfolio/img/logo.png" alt="Matt Harrison"/>
                </a>
                <div>
                    <h1><?= $section; ?> by Matt Harrison</h1>
                </div>
                <div>
                    <a href="mailto:pro.matt.harrison@gmail.com">pro.matt.harrison@gmail.com</a>
                </div>
            </div>
