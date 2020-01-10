<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

$id   = $_GET['id'] != NULL ? $_GET['id'] : 1;
$zoom = isset($_GET['zoom']) ? number_format($_GET['zoom']) : 8;

$row      = select("SELECT * FROM mattman WHERE id = $id", 'kittenb1_nerd')[0];
$rowCount = select("SELECT COUNT(id) AS rowCount FROM mattman", 'kittenb1_nerd')[0]['rowCount'];

$meta = array(
  'description' => $row['caption'],
  'image'       => $row['gif'],
  'title'       => $row['title']
);

$iPad   = stripos($_SERVER['HTTP_USER_AGENT'], 'iPad');
$iPhone = stripos($_SERVER['HTTP_USER_AGENT'], 'iPhone');
$iPod   = stripos($_SERVER['HTTP_USER_AGENT'], 'iPod');
$webOS  = stripos($_SERVER['HTTP_USER_AGENT'], 'webOS');

if ($row['width'] != NULL) {
  if ($row['width'] >= 120) {
    $embedW = $_GET['w'];
  } else {
    $embedW = 120;
  }
} else {
  $embedW = 120;
}

if ($row['height'] != NULL) {
  $embedH = $row['height']+20;
} else {
  $embedH = 120;
}

if ($_GET['zoom'] != NULL) {
  $embedW *= $_GET['zoom'];
  $embedH *= $_GET['zoom'];
} else {
  $embedW *= 4;
  $embedH *= 4;
}
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="line mAuto w1000">
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
  <div class="mAuto mb1 p20 bdrBox bgWhite">
    <div class="mAuto noSelect">
      <div class="line mb10">
        <h2 class="unit mr5 mb0 bold">
          <a href="index.php?id=<?= $row['id']; ?>"><?= $row['title']; ?></a>
        </h2>
        <p class="unitR">
          <a href="index.php?id=<?= $id; ?>&zoom=1" class="mr5">small</a>
          <a href="index.php?id=<?= $id; ?>&zoom=4" class="mr5">medium</a>
          <a href="index.php?id=<?= $id; ?>&zoom=8">large</a>
        </p>
      </div>
      <div>
        <?php if ($iPod || $iPhone || $iPad || $webOS) { ?>
          <img src="<?= $row['gif']; ?>" alt="" class="mAuto mb5"/>
        <?php } else { ?>
          <div class="mAuto txtC">
            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="' . $embedW . '" height="' . $embedH . '" id="anim" align="middle">
              <param name="allowScriptAccess" value="sameDomain"/>
              <param name="allowFullScreen" value="false"/>
              <param name="movie" value="/projects/nerd/mattman/flash/anim.swf?url=<?= $row['url']; ?>"/>
              <param name="quality" value="high"/>
              <embed src="/projects/nerd//flash/anim.swf?url=<?= $row['url']; ?>" quality="high" width="<?= $embedW; ?>" height="<?= $embedH; ?>" name="anim" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"/>
            </object>
          </div>
        <?php } ?>
      </div>
      <div class="mAuto pt5 w500"><?= $row['caption']; ?></div>
    </div>
  </div>
  <?php if ($_COOKIE['username'] == 'matt!') { ?>
    <?php $title = $row['title']; ?>
    <div class="mAuto mb1 p20 bdrBox bgGray private">
      <div class="line">
        <div class="unit mr5 w100">
          <p class="mb5 txtR label">title:</p>
          <p class="mb5 txtR label">url:</p>
          <p class="mb5 txtR label">gif:</p>
          <p class="mb5 txtR label">tags:</p>
          <p class="mb5 txtR label">caption:</p>
        </div>
        <form enctype="multipart/form-data" action="update.php" method="post" target="get.html" class="unitF">
          <input type="hidden" name="table" value="mattman"/>
          <input type="hidden" name="id" value="<?= $row['id']; ?>"/>
          <input type="text" name="title" class="mb5 wFull" value="<?= $row['title']; ?>"/>
          <input type="text" name="url" class="mb5 wFull" value="<?= $row['url']; ?>"/>
          <input type="text" name="gif" class="mb5 wFull" value="<?= $row['gif']; ?>"/>
          <input type="text" name="tags" class="mb5 wFull" value="<?= $row['tags']; ?>"/>
          <input type="text" name="width" class="mb5 wFull" value="<?= $row['width']; ?>"/>
          <input type="text" name="height" class="mb5 wFull" value="<?= $row['height']; ?>"/>
          <textarea name="caption" class="mb5 wFull" rows="10"><?= $row['caption']; ?></textarea>
          <input type="submit" value="update"/>
        </form>
      </div>
    </div>
  <?php } ?>
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'); ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
