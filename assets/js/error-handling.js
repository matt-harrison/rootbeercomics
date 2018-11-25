function showErrors(errors) {
  if (errors.length > 0) {
    $('#errors').html('').removeClass('hide');
    errors.forEach(error => {
      $('#errors').append('<p>' + error + '</p>');
    });
  }
}
