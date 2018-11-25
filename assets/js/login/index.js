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
