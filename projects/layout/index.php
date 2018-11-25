<?php
$sheetList        = array();
$readOrder        = array();
$halfPageOrder    = array();
$quarterPageOrder = array();
$appendices       = array('i', 'ii', 'iii', 'iv', 'v', 'vi', 'vii');
$hasCovers        = isset($_GET['covers']);
$hasCopyright     = isset($_GET['copyright']);
$isQuarter        = isset($_GET['quarter']);
$pages            = isset($_GET['pages']) ? $_GET['pages'] : 8;
$pagesPerSheet    = ($isQuarter) ? 8 : 4;

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
if (count($readOrder) % $pagesPerSheet != 0) {
	$pageCount = count($readOrder);
	$total     = (floor($pageCount / $pagesPerSheet) + 1) * $pagesPerSheet;
	$diff      = $total - $pageCount;

	for ($i = $pages + 1; $i <= $pages + $diff; $i++) {
		if ($hasCovers) {
			array_splice($readOrder, count($readOrder) - 1, 0, '<span class="txtRed">' . $i . '</span>');
		} else {
			array_push($readOrder, '<span class="txtRed">' . $i . '</span>');
		}
	}
}

//Determine half page order
$sideCount = count($readOrder) / 2;
$counterA  = count($readOrder) - 1;
$counterB  = 0;

for ($side = 0; $side < $sideCount; $side++) {
	if ($side % 2 == 0) {
		$halfPageOrder[] = $readOrder[$counterA];
		$halfPageOrder[] = $readOrder[$counterB];
	} else {
		$halfPageOrder[] = $readOrder[$counterB];
		$halfPageOrder[] = $readOrder[$counterA];
	}

	$counterA--;
	$counterB++;
}

//Determine quarter page order
$sideCount = count($readOrder) / 4;
$counterA  = count($readOrder) - 1;
$counterB  = 0;
$counterC  = count($readOrder) * 0.75 - 1;
$counterD  = count($readOrder) * 0.25;

for ($side = 0; $side < $sideCount; $side++) {
  if ($side % 2 == 0) {
	$quarterPageOrder[] = $readOrder[$counterA];
	$quarterPageOrder[] = $readOrder[$counterB];
	$quarterPageOrder[] = $readOrder[$counterC];
	$quarterPageOrder[] = $readOrder[$counterD];
  } else {
	$quarterPageOrder[] = $readOrder[$counterB];
	$quarterPageOrder[] = $readOrder[$counterA];
	$quarterPageOrder[] = $readOrder[$counterD];
	$quarterPageOrder[] = $readOrder[$counterC];
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
		<link type="text/css" href="/assets/css/library.css" rel="stylesheet"/>
		<link type="text/css" href="/assets/css/grid.css" rel="stylesheet"/>
		<link type="image/x-icon" href="/images/icons/r.ico" rel="icon"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<style>
			body {line-height: 1;}
			.bdrRight {border-right: 1px solid #000;}
			.bdrBottom {border-bottom: 1px dashed #000;}
			.w50 {width: 50px;}
			.page {
				width:  30px;
				height: 40px;
			}
			.txtRed {color: red;}
		</style>
		<script type="text/javascript">
			var url, pages, covers, copyright, querystring;

			$(function() {
				$('#btnSubmit').click(function() {
					url         = '/projects/layout/index.php'
					pages       = Number($('#pages').val());
					covers      = $('#chkCovers').prop('checked');
					copyright   = $('#chkCopyright').prop('checked');
					quarter     = $('#chkQuarter').prop('checked');
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
					if (quarter) {
						querystring.push('quarter');
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

				$('#btnReset').click(function() {
					window.location = '/projects/layout';
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
					<div id="comicForm" class="p10 bdrGray">
						<?php if ($diff > 0) { ?>
							<p class="mb20 txtRed">* <?= $diff; ?> pages were added to make page count divisible by <?= ($isQuarter) ? '8' : '4'; ?>.</p>
						<?php } ?>
						<div class="mb20">
							<label for="pages" class="mb5">interior page count:</label>
							<input type="text" id="pages" value="<?= $pages; ?>" class="w50 txtC"/>
						</div>
						<div class="mb20">
							<div class="flex">
								<input type="radio" id="chkHalf" name="quarter"<?= ($isQuarter) ? '' : ' checked="checked"'; ?> class="mr5 mb5"/>
								<label for="chkHalf">2 pages per side</label>
							</div>
							<div class="flex">
								<input type="radio" id="chkQuarter" name="quarter"<?= ($isQuarter) ? ' checked="checked"' : '' ; ?> class="mr5 mb5"/>
								<label for="chkQuarter">4 pages per side</label>
							</div>
						</div>
						<div class="mb20">
							<div class="flex">
								<input type="radio" id="chkCovers" name="covers"<?= ($hasCovers) ? ' checked="checked"' : ''; ?> class="mr5 mb5"/>
								<label for="chkCovers">covers</label>
							</div>
							<div class="flex">
								<input type="radio" id="chkNoCovers" name="covers"<?= ($hasCovers) ? '' : ' checked="checked"' ; ?> class="mr5 mb5"/>
								<label for="chkNoCovers">no covers</label>
							</div>
						</div>
						<div class="mb20">
							<div class="flex">
								<input type="radio" id="chkCopyright" name="copyright"<?= ($hasCopyright) ? ' checked="checked"' : ''; ?> class="mr5 mb5"/>
								<label for="chkCopyright">copyright</label>
							</div>
							<div class="flex">
								<input type="radio" id="chkNoCopyright" name="copyright"<?= ($hasCopyright) ? '' : ' checked="checked"' ; ?> class="mr5 mb5"/>
								<label for="chkNoCopyright">no copyright</label>
							</div>
						</div>
						<div class="flex">
							<button type="button" id="btnSubmit" class="mr5">submit</button>
							<button type="button" id="btnReset">reset</button>
						</div>
					</div>
				</div>
				<div class="flex100 m-flex66">
					<div class="flex spaceEvenly">
						<p class="runDemo">read order:</p>
						<p>print layout:</p>
					</div>
					<div class="flex spaceEvenly">
						<div>
							<div class="flex flexEnd mb5">
								<div class="page">&nbsp;</div>
								<div class="flex flexCenter alignCenter bdrBlack bgWhite page"><?= $readOrder[0]; ?></div>
							</div>
							<?php for ($i = 1; $i < count($readOrder) - 1; $i++) { ?>
								<?php if ($i % 2 === 1) { ?>
									<?php
									$pageLeft  = $readOrder[$i];
									$pageRight = $readOrder[$i + 1];
									?>
									<div class="flex mb5">
										<div class="flex bdrBlack">
											<div class="flex flexCenter alignCenter bdrRight bgWhite page"><?= $pageLeft; ?></div>
											<div class="flex flexCenter alignCenter bgWhite page"><?= $pageRight; ?></div>
										</div>
									</div>
								<?php } ?>
							<?php } ?>
							<div class="flex mb5">
								<div class="flex flexCenter alignCenter bdrBlack bgWhite page"><?= $readOrder[count($readOrder) - 1]; ?></div>
							</div>
						</div>
						<?php if ($isQuarter) { ?>
							<div>
								<?php $iteration = 0; ?>
								<?php for ($i = 0; $i < count($quarterPageOrder); $i++) { ?>
									<?php if ($i % 4 === 0) { ?>
										<?php
										$sheet       = floor($iteration / 2) + 1;
										$side        = ($iteration % 2 === 0) ? 'A' : 'B';
										$topLeft     = $quarterPageOrder[$i];
										$topRight    = $quarterPageOrder[$i + 1];
										$bottomLeft  = $quarterPageOrder[$i + 2];
										$bottomRight = $quarterPageOrder[$i + 3];
										?>
										<div class="flex alignCenter">
											<p class="mr5 mb0">
												<span class="hide m-show">sheet <?= $sheet; ?>,<br/>side <?= $side; ?>:</span>
												<span class="m-hide"><?= $sheet . $side; ?>: </span>
											</p>
											<div class="mb5 bdrBlack">
												<div class="flex">
													<div class="flex flexCenter alignCenter bdrRight bdrBottom bgWhite page"><?= $topLeft; ?></div>
													<div class="flex flexCenter alignCenter bdrBottom bgWhite page"><?= $topRight; ?></div>
												</div>
												<div class="flex">
													<div class="flex flexCenter alignCenter bdrRight bgWhite page"><?= $bottomLeft; ?></div>
													<div class="flex flexCenter alignCenter bgWhite page"><?= $bottomRight; ?></div>
												</div>
											</div>
										</div>
										<?php $iteration++; ?>
									<?php } ?>
								<?php } ?>
							</div>
						<?php } else { ?>
							<div>
								<?php $iteration = 0; ?>
								<?php for ($i = 0; $i < count($halfPageOrder); $i++) { ?>
									<?php if ($i % 2 === 0) { ?>
										<?php
										$sheet = floor($iteration / 2) + 1;
										$side  = ($iteration % 2 === 0) ? 'A' : 'B';
										$pageLeft  = $halfPageOrder[$i];
										$pageRight = $halfPageOrder[$i + 1];
										?>
										<div class="flex alignCenter mb5">
											<p class="mr5 mb0">
												<span class="hide m-show">sheet <?= $sheet; ?>,<br/>side <?= $side; ?>:</span>
												<span class="m-hide"><?= $sheet . $side; ?>: </span>
											</p>
											<div class="flex bdrBlack">
												<div class="flex flexCenter alignCenter bdrRight bgWhite page"><?= $pageLeft; ?></div>
												<div class="flex flexCenter alignCenter bgWhite page"><?= $pageRight; ?></div>
											</div>
										</div>
										<?php $iteration++; ?>
									<?php } ?>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>