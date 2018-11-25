<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<?php if (empty($_COOKIE['username'])) { ?>
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
      <p>Welcome, <?= $_COOKIE['username']; ?></p>
      <p class="mb0">
        <a href="/login/edit.php">Edit Profile</a>
        <span> | </span>
        <a href="/login/log-out.php">Log Out</a>
      </p>
    </div>
  </div>
<?php } ?>
<script type="text/javascript">
  $(function() {
    $('#loginForm').submit(function(event) {
      event.preventDefault();
      $('#errors').html('');

      let username = $('[name="username"]').val();
      let password = $('[name="password"]').val();
      let errors   = [];

      if (username === '') {
        errors.push('Please specify a valid username.');
      }

      if (password === '') {
        errors.push('Password required.');
      }

      if (errors.length > 0) {
        showErrors(errors);
      } else {
        $.ajax({
          type: 'POST',
          url: '/login/sql.php',
          dataType: 'json',
          data: {
            action  : 'log-in',
            username: $('[name="username"]').val(),
            password: $('[name="password"]').val()
          },
          success: function(response) {
            if (response.success) {
              location.reload();
            } else {
              showErrors(response.errors);
            }
          },
          error: function(response) {
            showErrors(['An error occurred. Please try again.']);
          }
        });
      }
    });
  });

  function showErrors(errors) {
    if (errors.length > 0) {
      $('#errors').html('').removeClass('hide');
      errors.forEach(error => {
        $('#errors').append('<p>' + error + '</p>');
      });
    }
  }
</script>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
