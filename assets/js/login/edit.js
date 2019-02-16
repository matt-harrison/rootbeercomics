$(function() {
  $('#editLoginForm').submit(function(event) {
    event.preventDefault();
    $('#errors').html('');

    const username    = $('[name="username"]').val();
    const oldPassword = $('[name="oldPassword"]').val();
    const password1   = $('[name="password1"]').val();
    const password2   = $('[name="password2"]').val();
    const errors      = [];

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
      const oldHash = md5(username + oldPassword);
      const newHash = md5(username + password1);

      $.ajax({
        type: 'POST',
        url: '/login/ajax/edit.php',
        dataType: 'json',
        data: {
          username: username,
          oldMd5: oldHash,
          newMd5: newHash
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
