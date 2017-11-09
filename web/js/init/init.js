//Set iniative order on the page

//Move ini one
$(document).ready(function () {

  var turn = $('.initlist').children(':first').text();

  $('#turn').html(turn);

  $('button#next').on('click', function (event) {

    $.get('/redirect', function () {}
    );

    //console.log('this thing');
    $('.initlist').append($('.initlist').children(':first'));

    var turn = $('.initlist').children(':first').text();

    $('#turn').html(turn);
  });
});
