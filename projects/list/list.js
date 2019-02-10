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
  var time  = today.getHours() + ':' + today.getMinutes() + ':' + today.getSeconds();

  var date  = new Date(year + '-' + month + '-' + day + ' ' + time);

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
      var num   = key + 1;
      var item  = data.title;
      var date  = new Date(data.date);
      var month = (date.getMonth() + 1).toString().padStart(2, '0');
      var day   = date.getDate().toString().padStart(2, '0');
      var year  = date.getFullYear().toString().substr(2, 2);

      if (!data.first) {
        item = '[' + item + ']';
      }

      item += ' (' + month + day + year + ')';

      $('#items').prepend('<p>' + num + '. ' + item + '</p>');
    });
  });
}
