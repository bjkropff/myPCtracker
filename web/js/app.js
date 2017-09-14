$(document).ready(function () {

  $('button#next').on('click', function (event) {
    //console.log('this thing');

    $('.initlist').append($('.initlist').children(':first'));

  });
});
