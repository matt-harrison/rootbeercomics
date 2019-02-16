$(function() {
  $('#registerLoginForm').submit(function(event) {
    event.preventDefault();
    $('#errors').html('');

    const firstName = $('[name="firstName"]').val();
    const lastName  = $('[name="lastName"]').val();
    const email     = $('[name="email"]').val();
    const username  = $('[name="username"]').val();
    const password1 = $('[name="password1"]').val();
    const password2 = $('[name="password2"]').val();
    const errors    = [];

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
      const hash = md5(username + password1);

      $.ajax({
        type: 'POST',
        url: '/login/ajax/register.php',
        dataType: 'json',
        data: {
          firstName: firstName,
          lastName : lastName,
          email    : email,
          username : username,
          md5      : hash
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
