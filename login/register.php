<?php $scripts[] = '/includes/js/register.js'; ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<form id="register" method="post" class="mAuto mb20 bdrGray p10 w400 bgWhite">
  <input type="text" name="fname" placeholder="First Name" value="<?= $_REQUEST['fname']; ?>" class="bdrBox mb10 p5 wFull fs16"/>
  <input type="text" name="lname" placeholder="Last Name" value="<?= $_REQUEST['lname']; ?>" class="bdrBox mb10 p5 wFull fs16"/>
  <input type="text" name="email" placeholder="Email" value="<?= $_REQUEST['email']; ?>" class="bdrBox mb10 p5 wFull fs16"/>
  <input type="text" name="username" placeholder="Username" class="bdrBox mb10 p5 wFull fs16"/>
  <input type="password" name="password1" placeholder="Password" class="bdrBox mb10 p5 wFull fs16"/>
  <input type="password" name="password2" placeholder="Re-enter Password" class="bdrBox mb10 p5 wFull fs16"/>
  <fieldset class="line">
    <input type="submit" id="submit" value="Submit" class="unitR mb20 p5 fs16"/>
  </fieldset>
  <p>
    <span>Have an account?</span>
    <a href="index.php">Log in.</a>
  </p>
</form>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
