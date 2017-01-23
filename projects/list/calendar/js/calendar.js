var months = [
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

var date  = new Date();
var year  = date.getFullYear();
var month = date.getMonth();

//Check GET params for month and year preselection.
var params = parseQueryString();
year  = params['year'] || year;
month = (params['month']) ? (parseInt(params['month']) - 1) : month;

twoDigitMonth = prefill(month + 1, 2, '0');

$(function() {
    getBooks();
    getComics();
    getMovies();
});

function getBooks() {
    var time = new Date().getTime();
    $.getJSON('../books/json/books.json?t=' + time, function(response) {
        books = response.books;
        for (var i = 0; i < books.length; i++) {
            books[i].month = prefill(books[i].month, 2, '0');
            books[i].day   = prefill(books[i].day, 2, '0');
            books[i].date  = books[i].year + books[i].month + books[i].day;
            books[i].type = 'book';
        }
        checkData();
    });
}

function getComics() {
    var time = new Date().getTime();
    $.getJSON('../comics/json/comics.json?t=' + time, function(response) {
        comics = response.comics;
        for (var i = 0; i < comics.length; i++) {
            comics[i].month = prefill(comics[i].month, 2, '0');
            comics[i].day   = prefill(comics[i].day, 2, '0');
            comics[i].date  = comics[i].year + comics[i].month + comics[i].day;
            comics[i].type = 'comic';
        }
        checkData();
    });
}

function getMovies() {
    var time = new Date().getTime();
    $.getJSON('../movies/json/movies.json?t=' + time, function(response) {
        movies = response.movies;
        for (var i = 0; i < movies.length; i++) {
            movies[i].month = prefill(movies[i].month, 2, '0');
            movies[i].day   = prefill(movies[i].day, 2, '0');
            movies[i].date  = movies[i].year + movies[i].month + movies[i].day;
            movies[i].type = 'movie';
        }
        checkData();
    });
}

function checkData() {
    if (typeof(books) != 'undefined' && typeof(comics) != 'undefined' && typeof(movies) != 'undefined') {
        entertainment = books.concat(comics, movies);
        entertainment.sort(sortByFullDate);

        $('#year').val(year);
        $('#month').val(month);

        $('#month, #year').change(function () {
            year          = parseInt($('#year').val());
            month         = parseInt($('#month').val());
            showCalendar();
            populateCalendar();
        });

        showCalendar();
        populateCalendar();

        $('.btnBooks, .btnComics, .btnMovies').click(function () {
            $(this).toggleClass('selected');
            var type = $(this).data('type');
            $('.' + type).toggleClass('hide');
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

        //showList();
    }
}

function showCalendar() {
    $('#calendar .week').remove();

    twoDigitMonth = prefill(month + 1, 2, '0');

    var daysInMonth = months[month].days;
    if (month == 1 && year % 4 == 0) {
        daysInMonth = 29;
    }
    var firstDayOfMonth = new Date(year, month, 1).getDay();
    var weeks = Math.ceil((daysInMonth + firstDayOfMonth) / 7);

    var box = 1;
    var dayOfMonth = 1;
    for (var week = 0; week < weeks; week++) {
        $('#calendar').append('<div id="week' + week + '" class="dRow week"/>');
        var newWeek = $('#week' + week);
        for (var dayofWeek = 0; dayofWeek < 7; dayofWeek++) {
            var id = '';
            var display = '';
            var emptiness = ' empty';
            if (box > firstDayOfMonth && dayOfMonth <= daysInMonth) {
                var twoDigitDay   = prefill(dayOfMonth, 2, '0');
                id = year + twoDigitMonth + twoDigitDay;
                display = dayOfMonth;
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
    var current = [];
    
    $('.calendarBox').addClass('emptyBox');
    
    for (var i = 0; i < entertainment.length; i++) {
        if (entertainment[i].month == twoDigitMonth && entertainment[i].year == year) {
            current.push(entertainment[i])
        }
    }

    for (var i = 0; i < current.length; i++) {
        var id = current[i].year + current[i].month + current[i].day;
        switch (current[i].type) {
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
        if (!current[i].first) {
            classList = 'lighter ' + classList;
        }
        
        var div = $('#' + id);
        div.removeClass('emptyBox');
        div.find('ul').append('<li class="' + classList + current[i].type + '">&#8226; ' + current[i].title + '</li>');
    }
}

function showList() {
    $('#list').removeClass('hide');
    for (var i = 0; i < entertainment.length; i++) {
        var date = entertainment[i].month + '.' + entertainment[i].day + '.' + entertainment[i].year;
        var record = $('.listItemTemplate').clone();
        record.removeClass('listItemTemplate hide').appendTo($('#list'));
        record.find('.date').text(date);
        record.find('.type').text(entertainment[i].type);
        record.find('.title').text(entertainment[i].title);

        if (!entertainment[i].first) {
            record.find('.title').addClass('lighter');
        }
    }
}

function parseQueryString() {
    var params = [];
    var data = window.location.search.replace('?', '');
    data = data.split('&');
    for (var i = 0; i < data.length; i++) {
        var param = data[i].split('=');
        var key = param[0];
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

function prefill(str, length, character) {
    var copy = str = str.toString();
    if (str.length < length) {
        for (var i = 0; i < length - str.length; i++) {
            copy = character + copy;
        }
    }
    return copy;
}
