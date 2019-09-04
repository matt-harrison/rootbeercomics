function getGyro() {
  if (window.orientation == 0) {
    $('#frame').removeClass('hor').addClass('vert');
    $('#corner1').removeClass('hor').addClass('vert');
    $('#corner2').removeClass('hor').addClass('vert');
    $('#corner3').removeClass('hor').addClass('vert');
    $('#corner4').removeClass('hor').addClass('vert');
  } else if(window.orientation == 90 || window.orientation == -90) {
    $('#frame').removeClass('vert').addClass('hor');
    $('#corner1').removeClass('vert').addClass('hor');
    $('#corner2').removeClass('vert').addClass('hor');
    $('#corner3').removeClass('vert').addClass('hor');
    $('#corner4').removeClass('vert').addClass('hor');
  }
  distribute();
}

window.onorientationchange = getGyro;
