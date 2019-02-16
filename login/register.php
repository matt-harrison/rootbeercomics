<?php $scripts[] = '/includes/js/register.js'; ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w400">
  <h1 class="mb5 bold">Register</h1>
  <form id="registerLoginForm" class="mAuto mb5 bdrGray p10 w400 bgWhite">
    <div id="errors" class="mb20 txtRed hide"></div>
    <input type="text" name="firstName" placeholder="First Name" value="<?= $_REQUEST['firstName']; ?>" class="bdrBox mb10 p5 wFull"/>
    <input type="text" name="lastName" placeholder="Last Name" value="<?= $_REQUEST['lastName']; ?>" class="bdrBox mb10 p5 wFull"/>
    <input type="text" name="email" placeholder="Email" value="<?= $_REQUEST['email']; ?>" class="bdrBox mb10 p5 wFull"/>
    <input type="text" name="username" placeholder="Username" class="bdrBox mb10 p5 wFull"/>
    <input type="password" name="password1" placeholder="Password" class="bdrBox mb10 p5 wFull"/>
    <input type="password" name="password2" placeholder="Re-enter Password" class="bdrBox mb10 p5 wFull"/>
    <fieldset class="flex flexEnd">
      <input type="submit" id="submit" value="Submit" class="p5"/>
    </fieldset>
  </form>
  <p class="mb0">
    <span>Have an account?</span>
    <a href="/login">Log in</a>.
  </p>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.10.0/js/md5.min.js"></script>
<script type="text/javascript" src="/assets/js/error-handling.js"></script>
<script type="text/javascript" src="/assets/js/login/register.js"></script>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
