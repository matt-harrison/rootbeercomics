var date          = new Date();
var params        = parseQueryString();
var year          = params['year'] || date.getFullYear();
var month         = (params['month']) ? (parseInt(params['month']) - 1) : date.getMonth();
var twoDigitMonth = (month + 1).toString().padStart(2, '0');
var months        = [
  {
    'name': 'January',
    'days': 31
  },
  {
    'name': 'February',
    'days': 28
  },
  {
    'name': 'March',
    'days': 31
  },
  {
    'name': 'April',
    'days': 30
  },
  {
    'name': 'May',
    'days': 31
  },
  {
    'name': 'June',
    'days': 30
  },
  {
    'name': 'July',
    'days': 31
  },
  {
    'name': 'August',
    'days': 31
  },
  {
    'name': 'September',
    'days': 30
  },
  {
    'name': 'October',
    'days': 31
  },
  {
    'name': 'November',
    'days': 30
  },
  {
    'name': 'December',
    'days': 31
  }
];

$(function() {
  $('#year').val(year);
  $('#month').val(month);

  $('#month, #year').change(function () {
    year  = parseInt($('#year').val());
    month = parseInt($('#month').val());

    showCalendar();
    populateCalendar();
  });

  $('.btnBooks, .btnComics, .btnMovies').click(function () {
    var type = $(this).data('type');

    $('.' + type).toggleClass('hide');
    $(this).toggleClass('selected');
  });

  $('.btnBack').click(function () {
    if (month > 0) {
      month--;
    } else {
      month = 11;
      year--;
    }

    $('#year').val(year);
    $('#month').val(month);

    showCalendar();
    populateCalendar();
  });

  $('.btnForward').click(function () {
    if (month < 11) {
      month++;
    } else {
      month = 0;
      year++;
    }

    $('#year').val(year);
    $('#month').val(month);

    showCalendar();
    populateCalendar();
  });

  getItems();
});

function getItems() {
  var time = new Date().getTime();

  $.getJSON('/projects/list/get.php?t=' + time, function(response) {
    items = response.items;

    items.forEach((item, index) => {
      var date = new Date(item.date);

      item.month = (date.getMonth() + 1).toString().padStart(2, '0');
      item.day   = date.getDate().toString().padStart(2, '0');
      item.year  = date.getFullYear();
    });

    showCalendar();
    populateCalendar();
  });
}

function showCalendar() {
  var firstDayOfMonth = new Date(year, month, 1).getDay();
  var daysInMonth     = months[month].days;
  var weeks           = Math.ceil((daysInMonth + firstDayOfMonth) / 7);
  var box             = 1;
  var dayOfMonth      = 1;

  twoDigitMonth = (month + 1).toString().padStart(2, '0');

  if (month == 1 && year % 4 == 0) {
    daysInMonth = 29;
  }

  $('#calendar .week').remove();

  for (var week = 0; week < weeks; week++) {
    $('#calendar').append('<div id="week' + week + '" class="dRow week"/>');

    var newWeek = $('#week' + week);

    for (var dayofWeek = 0; dayofWeek < 7; dayofWeek++) {
      var id        = '';
      var display   = '';
      var emptiness = ' empty';

      if (box > firstDayOfMonth && dayOfMonth <= daysInMonth) {
        var twoDigitDay = dayOfMonth.toString().padStart(2, '0');

        id        = year + twoDigitMonth + twoDigitDay;
        display   = dayOfMonth;
        emptiness = '';

        dayOfMonth++;
      }

      newWeek.append('<div id="' + id + '" class="dCell bdrBox p5 rel' + emptiness + ' calendarBox"/>');
      newWeek.find('.dCell:last').append('<p class="bold abs calendarDate">' + display + '</p>');
      newWeek.find('.dCell:last').append('<ul/>');
      box++;
    }
  }

  $('#displayDate').text(months[month].name + ' ' + year);
}

function populateCalendar() {
  $('.calendarBox').addClass('emptyBox');

  items.forEach(item => {
    if (item.month == twoDigitMonth && item.year == year) {
      var id  = item.year + item.month + item.day;
      var div = $('#' + id);

      switch (item.type) {
        case 'book':
          classList = 'txtBlue ';

          if (!$('.btnBooks').hasClass('selected')) {
            classList += 'hide ';
          }
          break;
        case 'comic':
          classList = 'txtRed ';

          if (!$('.btnComics').hasClass('selected')) {
            classList += 'hide ';
          }
          break;
        case 'movie':
          classList = 'txtGreen ';

          if (!$('.btnMovies').hasClass('selected')) {
            classList += 'hide ';
          }
          break;
      }

      if (item.first !== '1') {
        classList = 'lighter ' + classList;
      }

      div.removeClass('emptyBox');
      div.find('ul').append('<li class="' + classList + item.type + '">&#8226; ' + item.title + '</li>');
    }
  });
}

function showList() {
  $('#list').removeClass('hide');

  for (var i = 0; i < items.length; i++) {
    var date   = items[i].month + '.' + items[i].day + '.' + items[i].year;
    var record = $('.listItemTemplate').clone();

    record.removeClass('listItemTemplate hide').appendTo($('#list'));
    record.find('.date').text(date);
    record.find('.type').text(items[i].type);
    record.find('.title').text(items[i].title);

    if (!items[i].first) {
      record.find('.title').addClass('lighter');
    }
  }
}

function parseQueryString() {
  var params = [];
  var data   = window.location.search.replace('?', '').split('&');

  for (var i = 0; i < data.length; i++) {
    var param = data[i].split('=');
    var key   = param[0];
    var value = param[1];

    params[key] = value;
  }

  return params;
}

function sortByFullDate(a, b) {
  var sort = 0;

  if (a.date < b.date) {
    sort = 1;
  } else if (a.date > b.date) {
    sort = -1;
  }

  return sort;
}
