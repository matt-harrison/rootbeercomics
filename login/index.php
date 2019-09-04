<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<?php if (!$user->isSignedIn) { ?>
  <div class="mAuto w400">
    <h1 class="mb5 bold">Login</h1>
    <form id="loginForm" class="mb5 bdrGray p10 bgWhite">
      <div id="errors" class="mb20 txtRed hide"></div>
      <input type="text" name="username" placeholder="Username" class="bdrBox mb10 p5 wFull"/>
      <input type="password" name="password" placeholder="Password" class="bdrBox mb10 p5 wFull"/>
      <fieldset class="flex flexEnd">
        <input type="submit" value="Submit" class="p5"/>
      </fieldset>
    </form>
    <p class="mb0">
      <span>Need an account?</span>
      <a href="/login/register.php">Register</a>.
    </p>
  </div>
<?php } else { ?>
  <div class="mAuto w400">
    <h1 class="mb5 bold">Profile</h1>
    <div class="mb20 bdrGray p10 bgWhite">
      <p>Welcome, <?= $user->name; ?></p>
      <p class="mb0">
        <a href="/login/edit.php">Edit Profile</a>
        <span> | </span>
        <span id="logOutLink" class="fakeLink">Log Out</span>
      </p>
    </div>
  </div>
<?php } ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.10.0/js/md5.min.js"></script>
<script src="/assets/js/error-handling.js"></script>
<script src="/assets/js/login/index.js"></script>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
