<?php
$title = 'platform';
$desc  = 'prototype for a flash-based platformer, by matt harrison.';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
    <?php
    $iPod   = stripos($_SERVER['HTTP_USER_AGENT'], 'iPod');
    $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], 'iPhone');
    $iPad   = stripos($_SERVER['HTTP_USER_AGENT'] , 'iPad');
    $webOS  = stripos($_SERVER['HTTP_USER_AGENT'], 'webOS');
?>
    <?php if($iPod || $iPhone || $iPad || $webOS){ ?>
        <div id="flash" class="mAuto mb5 p10 w800 txtC">
    <p class="fs48">flash is not available on this device.</p>
    <p class="fs48">go sit at a computer.</p>
    <p class="fs48">it's worth it.</p>
  </div>
    <?php } else { ?>
        <div id="flash" class="mAuto mb5 txtC">
    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="400" height="300" id="plat">
      <param name="allowScriptAccess" value="sameDomain"/>
      <param name="allowFullScreen" value="false"/>
      <param name="movie" value="plat.swf"/>
      <param name="quality" value="high"/>
      <embed src="plat.swf" quality="high" width="400" height="300" name="plat" align="middle" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="https://www.macromedia.com/go/getflashplayer"/>
    </object>
  </div>
  <div class="mAuto mb5 p10 w500 bgWhite">
    <p class="mb5">spacebar: jump</p>
    <p class="mb0">objective: get up there.</p>
  </div>
<?php } ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
