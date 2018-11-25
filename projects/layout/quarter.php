<?php
$sheetList    = array();
$readOrder    = array();
$printOrder   = array();
$appendices   = array('i', 'ii', 'iii');
$pages        = ($_GET['pages']) ? $_GET['pages'] : 8;
$hasCovers    = (isset($_GET['covers']) || isset($_GET['cover']));
$hasCopyright = (isset($_GET['copyright']) || isset($_GET['copyright']));

//Determine pages to include
for ($i = 1; $i <= $pages; $i++) {
	$readOrder[count($readOrder)] = $i;
}

if ($hasCopyright) {
	array_unshift($readOrder, '&copy;');
}

if ($hasCovers) {
	array_unshift($readOrder, 'F');
	array_push($readOrder, 'B');
}

//Determine read order
if (count($readOrder) % 4 != 0) {
	$pageCount = count($readOrder);
	$total     = (floor($pageCount / 4) + 1) * 4;
	$diff      = $total - $pageCount;

	for ($i = 0; $i < $diff; $i++) {
		if ($hasCovers) {
			array_splice($readOrder, count($readOrder) - 1, 0, $appendices[$i]);
		} else {
			array_push($readOrder, $appendices[$i]);
		}
	}
}

//Determine print order
$printOrder = [];
$sideCount  = count($readOrder) / 4;
$counterA   = count($readOrder) - 1;
$counterB   = 0;
$counterC   = count($readOrder) * 0.75 - 1;
$counterD   = count($readOrder) * 0.25;

for ($side = 0; $side < $sideCount; $side++) {
  if ($side % 2 == 0) {
	$printOrder[] = $readOrder[$counterA];
	$printOrder[] = $readOrder[$counterB];
	$printOrder[] = $readOrder[$counterC];
	$printOrder[] = $readOrder[$counterD];
  } else {
	$printOrder[] = $readOrder[$counterB];
	$printOrder[] = $readOrder[$counterA];
	$printOrder[] = $readOrder[$counterD];
	$printOrder[] = $readOrder[$counterC];
  }

	$counterA--;
	$counterB++;
	$counterC--;
	$counterD++;
}
?>
<!doctype html>
<html>
	<head>
		<title>minicomic layout generator, by matt!</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta property="og:title" content="minicomic layout generator, by matt!"/>
		<meta property="og:image" content=""/>
		<meta property="og:description" content="customizable guide to formatting minicomics for print"/>
		<meta property="og:url" content="<?= 'http://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>"/>
		<link type="text/css" href="/assets/css/styles.css" rel="stylesheet"/>
		<link type="text/css" href="/assets/css/grid.css" rel="stylesheet"/>
		<link type="image/x-icon" href="/images/icons/r.ico" rel="icon"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<style>
			body {line-height: 1;}
			.bdrRightBlack  {border-right:  1px solid #000;}
			.bdrBottomBlack {border-bottom: 1px dashed #000;}
			.page {
				width:  30px;
				height: 40px;
			}
		</style>
		<script type="text/javascript">
			var url, pages, covers, copyright, querystring;
			$(function() {
				$('#btnSubmit').click(function() {
					url         = '/projects/layout/index.php'
					pages       = Number($('#pages').val());
					covers      = $('#chkCovers').prop('checked');
					copyright   = $('#chkCopyright').prop('checked');
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
		<div class="mAuto container">
			<div id="mini-header" class="bsBorder flex column m-row spaceBetween mb5 bdrGray p10">
				<a href="/" class="m-mr10 mb10 m-mb0">rootbeercomics.com</a>
				<p class="mb0">minicomic layout generator</p>
			</div>
			<div class="flex column m-row">
				<div class="flex100 m-flex33 mb5">
					<form id="comicForm" class="p10 bdrGray">
						<div class="mb20">
							<label for="pages" class="mb5">interior pages:</label>
							<input type="text" id="pages" value="<?= $pages; ?>" class="w100 txtC"/>
						</div>
						<div class="mb20">
							<div class="flex">
								<input type="radio" id="chkCovers" name="covers"<?= ($hasCovers) ? ' checked="checked"' : ''; ?> class="mr5 mb5"/>
								<label for="chkCovers" class="">covers</label>
							</div>
							<div class="flex">
								<input type="radio" id="chkNoCovers" name="covers"<?= ($hasCovers) ? '' : ' checked="checked"' ; ?> class="mr5 mb5"/>
								<label for="chkNoCovers" class="">no covers</label>
							</div>
						</div>
						<div class="mb20">
							<div class="flex">
								<input type="radio" id="chkCopyright" name="copyright"<?= ($hasCopyright) ? ' checked="checked"' : ''; ?> class="mr5 mb5"/>
								<label for="chkCopyright" class="">copyright</label>
							</div>
							<div class="flex">
								<input type="radio" id="chkNoCopyright" name="copyright"<?= ($hasCopyright) ? '' : ' checked="checked"' ; ?> class="mr5 mb5"/>
								<label for="chkNoCopyright" class="">no copyright</label>
							</div>
						</div>
						<div class="flex">
							<button type="button" id="btnSubmit" class="">submit</button>
						</div>
					</form>
				</div>
				<div class="flex100 m-flex66">
					<div class="flex spaceAround">
						<p>read order:</p>
						<p>print order:</p>
					</div>
					<div class="flex spaceAround">
						<div>
							<div class="flex flexEnd mb5">
								<div class="flex flexCenter alignCenter bdrBlack bgWhite page"><?= $readOrder[0]; ?></div>
							</div>
							<?php for ($i = 1; $i < count($readOrder) - 1; $i++) { ?>
								<?php if ($i % 2 === 1) { ?>
									<?php
									$leftPage  = $readOrder[$i];
									$rightPage = $readOrder[$i + 1];
									?>
									<div class="flex mb5">
										<div class="flex bdrBlack">
											<div class="flex flexCenter alignCenter bdrRightBlack bgWhite page"><?= $leftPage; ?></div>
											<div class="flex flexCenter alignCenter bgWhite page"><?= $rightPage; ?></div>
										</div>
									</div>
								<?php } ?>
							<?php } ?>
							<div class="flex mb5">
								<div class="flex flexCenter alignCenter bdrBlack bgWhite page"><?= $readOrder[count($readOrder) - 1]; ?></div>
							</div>
						</div>
						<div>
							<?php for ($i = 0; $i < count($printOrder); $i++) { ?>
								<?php if ($i % 4 === 0) { ?>
									<?php
									$topLeft     = $printOrder[$i];
									$topRight    = $printOrder[$i + 1];
									$bottomLeft  = $printOrder[$i + 2];
									$bottomRight = $printOrder[$i + 3];
									?>
									<div class="mb5 bdrBlack">
										<div class="flex">
											<div class="flex flexCenter alignCenter bdrRightBlack bdrBottomBlack bgWhite page"><?= $topLeft; ?></div>
											<div class="flex flexCenter alignCenter bdrBottomBlack bgWhite page"><?= $topRight; ?></div>
										</div>
										<div class="flex">
											<div class="flex flexCenter alignCenter bdrRightBlack bgWhite page"><?= $bottomLeft; ?></div>
											<div class="flex flexCenter alignCenter bgWhite page"><?= $bottomRight; ?></div>
										</div>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>