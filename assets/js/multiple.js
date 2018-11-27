$(function() {
  $('.multiple').click(function() {
    var id      = $(this).data('id');
    var version = $(this).data('version');

    var group  = $('[data-id="' + id + '"]');
    var next   = (version < group.length - 1) ? 1 + version : 0;
    var target = group.filter('[data-version="' + next + '"]');

    group.addClass('hide');
    target.removeClass('hide');
  });
});
