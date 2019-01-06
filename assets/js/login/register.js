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
        url: '/login/ajax/register.php',
        dataType: 'json',
        data: {
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
