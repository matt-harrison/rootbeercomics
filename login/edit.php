<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w400">
  <h1 class="mb5 bold">Edit Profile</h1>
  <form id="editLoginForm" class="mAuto mb20 bdrGray p10 w400 bgWhite">
    <div id="errors" class="mb20 txtRed hide"></div>
    <p>Username: <?= $_COOKIE['username']; ?></p>
    <input type="password" name="oldPassword" placeholder="Old Password" class="bdrBox mb10 p5 wFull"/>
    <input type="password" name="password1" placeholder="New Password" class="bdrBox mb10 p5 wFull"/>
    <input type="password" name="password2" placeholder="Re-enter New Password" class="bdrBox mb10 p5 wFull"/>
    <fieldset class="flex flexEnd">
      <input type="submit" value="Submit" class="p5"/>
    </fieldset>
  </form>
</div>
<script type="text/javascript">
  $(function() {
    $('#editLoginForm').submit(function(event) {
      event.preventDefault();
      $('#errors').html('');

      let oldPassword = $('[name="oldPassword"]').val();
      let password1   = $('[name="password1"]').val();
      let password2   = $('[name="password2"]').val();
      let errors      = [];

      if (oldPassword === '') {
        errors.push('Old Password required.');
      }

      if (password1 === '') {
        errors.push('New Password required.');
      }

      if (password2 === '') {
        errors.push('Re-enter New Password required.');
      }

      if (password1 !== password2) {
        errors.push('Passwords did not match. Please try again.');
      }

      if (errors.length > 0) {
        showErrors(errors);
      } else {
        $.ajax({
          type: 'POST',
          url: '/login/sql.php',
          dataType: 'json',
          data: {
            action     : 'update',
            oldPassword: $('[name="oldPassword"]').val(),
            password1  : $('[name="password1"]').val(),
            password2  : $('[name="password2"]').val()
          },
          success: function(response) {
            if (response.success) {
              location.href = '/login';
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
