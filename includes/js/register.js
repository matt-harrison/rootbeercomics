$(function() {
  alert('pageload');
  $('#register').submit(function(event) {
    alert('test');
    event.preventDefault();
    $.ajax(
      {
        url: '/login/sql.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
          action: 'register'
        }
      },
      success: function(response) {

      }
    );
  });
});
