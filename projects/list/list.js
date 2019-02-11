var data;
var itemType;

$(function() {
  var today    = new Date;
      itemType = $('#items').data('type');

  showItems();

  $('#month').val(today.getMonth() + 1);
  $('#day').val(today.getDate());
  $('#year').val(today.getFullYear());

  $('#first').click(function() {
    var first = ($(this).html() == '') ? 'X' : '';

    $(this).html(first);
  });

  $('#btnAdd').click(function(event) {
    event.preventDefault();
    addItem();
  });

  $('#title').focus();
});

var addItem = function() {
  var today = new Date();
  var month = $('#month').val().padStart(2, '0');
  var day   = $('#day').val().padStart(2, '0');
  var year  = $('#year').val();
  var date  = year + '-' + month + '-' + day;

  item = {
    type : itemType,
    title: $('#title').val(),
    date : date,
    first: ($('#first').html() == 'X')
  };

  $('#title').val('').focus();

  $.ajax({
    data    : {data: JSON.stringify(item)},
    dataType: 'json',
    type    : 'POST',
    url     : '/projects/list/insert.php'
  }).always(function() {
    showItems();
  });
}

var showItems = function() {
  $('#items').html('');
  $.getJSON('/projects/list/get.php?type=' + itemType, function(response) {
    $.each(response.items, function(key, data) {
      var date  = new Date(data.date.substr(0, 10));
      var id    = key + 1;
      var title = data.title;
      var month = (date.getMonth() + 1).toString().padStart(2, '0');
      var day   = date.getDate().toString().padStart(2, '0');
      var year  = date.getFullYear().toString().substr(2, 2);
      var date6 = '(' + month + day + year + ')';

      if (!data.first) {
        title = '[' + title + ']';
      }

      $('#items').prepend('<p>' + id + '. ' + title + ' ' + date6 + '</p>');
    });
  });
}
