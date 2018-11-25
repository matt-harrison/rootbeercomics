<?php $scripts[] = '/includes/js/register.js'; ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mAuto w400">
  <h1 class="mb5 bold">Register</h1>
  <form id="registerLoginForm" class="mAuto mb5 bdrGray p10 w400 bgWhite">
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
<script type="text/javascript">
  $(function() {
    $('#registerLoginForm').submit(function(event) {
      event.preventDefault();
      $('#errors').html('');

      let firstName = $('[name="firstName"]').val();
      let lastName  = $('[name="lastName"]').val();
      let email     = $('[name="email"]').val();
      let username  = $('[name="username"]').val();
      let password1 = $('[name="password1"]').val();
      let password2 = $('[name="password2"]').val();
      let errors    = [];

      if (firstName === '') {
        errors.push('Please specify a valid First Name.');
      }

      if (lastName === '') {
        errors.push('Please specify a valid Last Name.');
      }

      if (email === '') {
        errors.push('Please specify a valid Email address.');
      }

      if (username === '') {
        errors.push('Please specify a valid username.');
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
            action   : 'create',
            firstName: $('[name="firstName"]').val(),
            lastName : $('[name="lastName"]').val(),
            email    : $('[name="email"]').val(),
            username : $('[name="username"]').val(),
            password1: $('[name="password1"]').val(),
            password2: $('[name="password2"]').val()
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
