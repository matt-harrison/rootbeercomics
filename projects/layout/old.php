<?php
$appendices = array('i', 'ii', 'iii');
if ($_GET['pages']) {
    $pages = $_GET['pages'];
} else {
    $pages = 8;
}
if (isset($_GET['covers']) || isset($_GET['cover'])) {
    $covers = true;
} else {
    $covers = false;
}
if (isset($_GET['copyright']) || isset($_GET['copyright'])) {
    $copyright = true;
} else {
    $copyright = false;
}

$pageList = array();
for ($i = 1; $i <= $pages; $i++) {
    $pageList[count($pageList)] = $i;
}

if ($covers) {
    array_unshift($pageList, 'F');
    array_push($pageList, 'B');
}

if ($copyright) {
    array_splice($pageList, 1, 0, '&copy;');
}

if (count($pageList) % 4 != 0) {
    $pageCount = count($pageList);
    $total     = (floor($pageCount / 4) + 1) * 4;
    $diff      = $total - $pageCount;

    for ($i = 0; $i < $diff; $i++) {
        if ($covers) {
            array_splice($pageList, count($pageList) - 1, 0, $appendices[$i]);
        } else {
            array_push($pageList, $appendices[$i]);
        }
    }
}
?>
<!doctype html>
<html>
    <head>
        <title><?= $title; ?></title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta property="og:title" content="<?= $title; ?>, by matt!"/>
        <meta property="og:image" content="<?= $img; ?>"/>
        <meta property="og:description" content="<?= $desc; ?>"/>
        <meta property="og:url" content="<?= 'http://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>"/>
        <link type="text/css" href="/includes/styles.css" rel="stylesheet"/>
        <link type="image/x-icon" href="/images/icons/r.ico" rel="icon"/>
        <link type="application/rss+xml" href="/scripts/feed.php" rel="alternate"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <style>
            .ml32 {margin-left: 32px;}
            .bdrBlackRt {border: 1px solid #000; border-left:0;}
            .w25  {width:  25px;}
            .w200 {width: 200px;}
            .w400 {width: 400px;}
            .page {
                padding-top   : 10px;
                padding-bottom: 10px;
                width         : 32px;
                height        : 15px;
            }
            #comicForm label {line-height: 18px;}
        </style>
        <script type="text/javascript">
            var url, pages, covers, copyright, querystring;
            $(function() {
                $('#btnSubmit').click(function() {
                    url = '/projects/layout/old.php'
                    pages = Number($('#pages').val());
                    covers = $('#covers').prop('checked');
                    copyright = $('#copyright').prop('checked');
                    querystring = [];

                    if (typeof(pages) == 'number') {
                        querystring.push('pages=' + pages);
                    }
                    if (covers) {
                        querystring.push('covers');
                    }
                    if (copyright) {
                        querystring.push('copyright');
                    }
                    for (var i = 0; i < querystring.length; i++) {
                        if (i == 0) {
                            url += '?' + querystring[i];
                        } else {
                            url += '&' + querystring[i];
                        }
                    }
                    window.location = url;
                });
            });
        </script>
    </head>
    <body class="m5">
        <div id="mini-header" class="line mAuto mb10 bdrGray p20 w800 bgGray txtDkBlue bdrBox">
            <a href="/" class="dBlock unit w200 bold">rootbeercomics.com</a>
            <p class="unit mb0 w400 txtC">minicomic layout generator</p>
        </div>
        <div class="line mAuto w800">
            <form id="comicForm" class="unit mr10 p10 size1of2 bdrGray bgGray bdrBox">
                <div class="line mb10">
                    <label for="pages" class="unit mr5">pages:</label>
                    <input type="text" id="pages" value="<?= $pages; ?>" class="unit w25"/>
                </div>
                <div class="line mb10">
                    <div class="unit size1of2">
                        <div class="line">
                            <input type="radio" id="covers" name="covers"<?= ($covers) ? ' checked="checked"' : ''; ?> class="unit mr5"/>
                            <label for="covers" class="unit">covers</label>
                        </div>
                        <div class="line">
                            <input type="radio" id="noCovers" name="covers"<?= ($covers) ? '' : ' checked="checked"' ; ?> class="unit mr5"/>
                            <label for="noCovers" class="unit">no covers</label>
                        </div>
                    </div>
                    <div class="unit size1of2">
                        <div class="line">
                            <input type="radio" id="copyright" name="copyright"<?= ($copyright) ? ' checked="checked"' : ''; ?> class="unit mr5"/>
                            <label for="copyright" class="unit">copyright</label>
                        </div>
                        <div class="line">
                            <input type="radio" id="noCopyright" name="copyright"<?= ($copyright) ? '' : ' checked="checked"' ; ?> class="unit mr5"/>
                            <label for="noCopyright" class="unit">no copyright</label>
                        </div>
                    </div>
                </div>
                <div class="line">
                    <button type="button" id="btnSubmit" class="unitRt">submit</button>
                </div>
            </form>
            <div class="unit w100">
                <p>read order:</p>
                <?php for ($i = 0; $i < count($pageList); $i++) { ?>
                    <?php if ($i == 0) { ?>
                        <div class="line mAuto mb5">
                            <div class="unit ml32 bdrBlack bgWhite page txtC"><?= $pageList[$i]; ?></div>
                        </div>
                    <?php } else if ($i == count($pageList) - 1) { ?>
                        <div class="line mAuto mb5">
                            <div class="unit bdrBlack bgWhite page txtC"><?= $pageList[$i]; ?></div>
                        </div>
                    <?php } else if ($i % 2 == 1) { ?>
                        <div class="line mAuto mb5">
                            <div class="unit bdrBlack bgWhite page txtC"><?= $pageList[$i]; ?></div>
                    <?php } else { ?>
                            <div class="unit mr10 bdrBlackRt bgWhite page txtC"><?= $pageList[$i]; ?></div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="unit w200">
                <p>print order:</p>
                <?php for ($i = 0; $i < count($pageList); $i++) { ?>
                    <?php
                    $sheet = floor(($i) / 2) + 1;
                    $front = ($i % 2) == 0;
                    $side = ($front) ? 'A' : 'B';
                    ?>
                    <div class="line mAuto mb5">
                        <?php if ($front) { ?>
                            <div class="unit bdrBlack bgWhite page txtC"><?= $pageList[count($pageList) - 1]; ?></div>
                            <div class="unit mr10 bdrBlackRt bgWhite page txtC"><?= $pageList[$i]; ?></div>
                        <?php } else { ?>
                            <div class="unit bdrBlack bgWhite page txtC"><?= $pageList[$i]; ?></div>
                            <div class="unit mr10 bdrBlackRt bgWhite page txtC"><?= $pageList[count($pageList) - 1]; ?></div>
                        <?php } ?>
                        <span class="unit mt10">sheet <?= $sheet . $side; ?></span>
                    </div>
                    <?php array_pop($pageList); ?>
                <?php } ?>
            </div>
        </div>
    </body>
</html>