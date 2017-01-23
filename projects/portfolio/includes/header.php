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
            <div id="header" class="mb20">
                <a href="/projects/portfolio" class="left w160">
                    <img src="/projects/portfolio/img/logo.png" alt="Matt Harrison"/>
                </a>
                <div class="dBlock left w480 txtC">
                    <h1><?= $section; ?> by Matt Harrison</h1>
                </div>
                <div class="dBlock right w160 txtR">
                    <a href="mailto:matthewdh@gmail.com">matthewdh@gmail.com</a>
                </div>
                <div class="clear"></div>
            </div>
