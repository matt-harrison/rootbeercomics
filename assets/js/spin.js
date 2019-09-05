function init() {
  x          = 0;
  frameCount = $('#sprite').attr('data-framecount') ? $('#sprite').attr('data-framecount') : 8;
  imgWidth   = $('#anim>img').width() * $('#anim').data('zoom');
  frameWidth = (imgWidth / frameCount);

  if (frameWidth < 100) {
    $('#buttons').removeClass('resize invisible').addClass('w100');
  }

  $('.resize').css('width', frameWidth).removeClass('invisible');
  $('#sprite').css('width', imgWidth);

  spin = 'cclock';

  stepForward();

  $('#playBackward').click(function() {
    spin = 'clock';
    stepBackward();
  });

  $('#stepBackward').click(function() {
    spin = '';
    stepBackward();
  });

  $('#stop').click(function() {
    clearInterval(int);
    spin = '';
  });

  $('#stepForward').click(function() {
    spin = '';
    stepForward();
  });

  $('#playForward').click(function() {
    spin = 'cclock';
    stepForward();
  });
};

function stepBackward() {
  if (typeof int != 'undefined') {
    clearInterval(int);
  }

  if (x < 0) {
    x += frameWidth;
  } else {
    x = frameWidth-imgWidth;
  }

  $('.anim>img').css('margin-left', x);

  if (spin == 'clock') {
    int = setTimeout(stepBackward, 1000/8);
  }
}

function stepForward() {
  if (typeof int != 'undefined') {
    clearInterval(int);
  }

  if (x > frameWidth-imgWidth) {
    x -= frameWidth;
  } else {
    x = 0;
  }

  $('.anim>img').css('margin-left', x);

  if (spin == 'cclock') {
    int = setTimeout(stepForward, 1000/8);
  }
}

$(function() {
  if (document.getElementById('sprite').complete) {
    init();
  } else {
    document.getElementById('sprite').addEventListener('load', init);
  }
});
