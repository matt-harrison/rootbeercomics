<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <title>matt's calendar</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="js/calendar.js"></script>
        <style>
            @charset "utf-8";

            .line:after {content: " x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x x"; visibility: hidden; clear: both; height: 0 !important; display: block; line-height: 0; font-size: xx-large; overflow: hidden;}
            .line {*zoom: 1;}
            .unit {float: left;}
            .unitRt {float: right;}

            body, ol, ul, li, p, input, button {
                display: block;
                margin: 0;
                border: 0;
                padding: 0;
            }

            body, p, input, button, select {font: 10pt courier new;}

            li {
                padding-left: 10px;
                text-indent: -10px;
            }

            .hide {display: none;}
            .dInlineBlock {display: inline-block;}
            .dTable {
                display: table;
                border-collapse: separate;
                border-spacing: 5px;
            }
            .dRow {display: table-row;}
            .dCell {
                display: table-cell;
                border: 1px solid gray;
                vertical-align: top;
            }

            .abs {position: absolute;}
            .rel {position: relative;}

            .m10 {margin: 10px;}
            .mb10 {margin-bottom: 10px;}
            .ml20 {margin-left: 20px;}
            .mAuto {
                margin-right: auto;
                margin-left: auto;
            }

            .bdrBox {
                box-sizing: border-box;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
            }
            .bdrGray {border: 1px solid #666;}

            .p5 {padding: 5px;}

            .size1of10 {width: 10%;}
            .size1of7 {width: 14%;}
            .size9of10 {width: 90%;}
            .wFull {width: 100%;}

            .bold {font-weight: bold;}
            .txtC {text-align: center;}

            .txtRed   {color: red;}
            .txtGreen {color: #363;}
            .txtBlue  {color: blue;}
            .lighter  {opacity: 0.75;}

            .bdrRed   {border: 1px solid red;}
            .bdrGreen {border: 1px solid #363;}
            .bdrBlue  {border: 1px solid blue;}

            .csrPointer {cursor: pointer;}

            .bgRed.selected   {background-color: #fdd;}
            .bgGreen.selected {background-color: #dfd;}
            .bgBlue.selected  {background-color: #ddf;}

            .calendarDate {
                top: 0;
                right: 0;
                color: #ddd;
                font-size: 40pt;
                line-height: 1;
                z-index: -1;
            }

            .calendarBox > ul {
                min-height: 100px;
            }

            @media screen and (max-width: 800px) {
                .dTable, .dRow, .dCell {display: block;}
                .dCell {margin-bottom: 5px;}

                #buttonBar {
                    display: block;
                    margin-bottom: 10px;
                }
                #heading, .empty {display: none;}
                #calendar {padding: 5px;}

                .emptyBox {display: none;}
            }
        </style>
    </head>
    <body>
        <header class="p5">
            <p class="mb10 bold">entertainment i've consumed</p>
            <form class="mb10">
                <span id="buttonBar">
                    <span data-type="book"  class="dInlineBlock bdrBlue  p5 txtBlue  bgBlue  btnBooks  selected csrPointer">books</span>
                    <span data-type="comic" class="dInlineBlock bdrRed   p5 txtRed   bgRed   btnComics selected csrPointer">comics</span>
                    <span data-type="movie" class="dInlineBlock bdrGreen p5 txtGreen bgGreen btnMovies selected csrPointer">movies</span>
                </span>
                <select id="month" class="p5">
                    <option value="0">January</option>
                    <option value="1">February</option>
                    <option value="2">March</option>
                    <option value="3">April</option>
                    <option value="4">May</option>
                    <option value="5">June</option>
                    <option value="6">July</option>
                    <option value="7">August</option>
                    <option value="8">September</option>
                    <option value="9">October</option>
                    <option value="10">November</option>
                    <option value="11">December</option>
                </select>
                <select id="year" class="p5">
                    <?php for ($year = 2001; $year <= date('Y'); $year++) { ?>
                        <option><?= $year; ?></option>
                    <?php } ?>
                </select>
            </form>
        </header>
        <h1 class="bold txtC">
            <span>
                <span class="p5 btnBack csrPointer">&lsaquo;</span>
                <span id="displayDate"></span>
                <span class="p5 btnForward csrPointer">&rsaquo;</span>
            </span>
        </h1>
        <div id="calendar" class="dTable bdrBox wFull">
            <div id="heading" class="dRow">
                <div class="dCell p5 size1of7 txtC bold">Sunday</div>
                <div class="dCell p5 size1of7 txtC bold">Monday</div>
                <div class="dCell p5 size1of7 txtC bold">Tuesday</div>
                <div class="dCell p5 size1of7 txtC bold">Wednesday</div>
                <div class="dCell p5 size1of7 txtC bold">Thursday</div>
                <div class="dCell p5 size1of7 txtC bold">Friday</div>
                <div class="dCell p5 size1of7 txtC bold">Saturday</div>
            </div>
        </div>
        <div id="list" class="p5 hide">
            <div class="listItemTemplate hide">
                <span class="date"></span>:
                <span>
                    [<span class="type"></span>]
                </span>
                <span class="title"></span>
            </div>
        </div>
    </body>
</html>
