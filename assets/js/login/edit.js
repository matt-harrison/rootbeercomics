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
        url: '/login/ajax/update.php',
        dataType: 'json',
        data: {
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
