<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w400">
  <h1 class="mb5 bold">Edit Profile</h1>
  <form id="editLoginForm" class="mAuto mb20 bdrGray p10 w400 bgWhite">
    <div id="errors" class="mb20 txtRed hide"></div>
    <p>Username: <?= $user->name; ?></p>
    <input type="hidden" name="username" value="<?= $user->name; ?>"/>
    <input type="password" name="oldPassword" placeholder="Old Password" class="bdrBox mb10 p5 wFull"/>
    <input type="password" name="password1" placeholder="New Password" class="bdrBox mb10 p5 wFull"/>
    <input type="password" name="password2" placeholder="Re-enter New Password" class="bdrBox mb10 p5 wFull"/>
    <fieldset class="flex flexEnd">
      <input type="submit" value="Submit" class="p5"/>
    </fieldset>
  </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.10.0/js/md5.min.js"></script>
<script src="/assets/js/error-handling.js"></script>
<script src="/assets/js/login/edit.js"></script>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
