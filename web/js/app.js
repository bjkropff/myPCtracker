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

  $('button#delete').on('click', function (event) {
    //Hide the 'dead' enemy
    var enemyName = $(this).parent('li').attr('id');
    console.log(enemyName);
    $(this).parent('li').remove();

    //Enemy name will display on turn after being deleted. This reset the turn.
    var turn = $('.initlist').children(':first').text();
    $('#turn').html(turn);


    $.post('/deleteEnemy/' +  enemyName, function () {}
    );

  });

});
