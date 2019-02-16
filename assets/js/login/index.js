$(function() {
  $('#logOutLink').click(function() {
    $.ajax({
      type: 'GET',
      url: '/login/ajax/log-out.php',
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          location.reload();
        }
      },
      error: function(response) {
        showErrors(['An error occurred. Please try again.']);
      }
    });
  });

  $('#loginForm').submit(function(event) {
    event.preventDefault();
    $('#errors').html('');

    const username = $('[name="username"]').val();
    const password = $('[name="password"]').val();
    const errors   = [];

    if (username === '') {
      errors.push('Please specify a valid username.');
    }

    if (password === '') {
      errors.push('Password required.');
    }

    if (errors.length > 0) {
      showErrors(errors);
    } else {
      const hash = md5(username + password);

      $.ajax({
        type: 'POST',
        url: '/login/ajax/index.php',
        dataType: 'json',
        data: {
          username: username,
          md5: hash
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
