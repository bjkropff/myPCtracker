var count = 0;

function addOne (number) {
  return '<div class="col-sm-3 enemy" >' +
          '<form id="' + number +'-id">' +
            '<input id="' + number + '-name"  placeholder="name" !required>' +
            '<input id="' + number + '-init"  placeholder="init">' +
            '<input id="' + number +'-ac" placeholder="ac">' +
            '<input id="' + number +'-hp" placeholder="hp">' +
          '</form>' +
          '<button class="btn btn-primary add" id="' + number
          + '">Add this enemy</button></div>';
}

var enemies = addOne(count);

$(document).ready(function () {
  $('#added').hide();
  $('#npcSection').html(addOne(count));

  $('button#addNPC').on('click', function () {
    count++;
    // enemies += addOne(count);
    $('#npcSection').append(addOne(count));
  });

  $('#pcSection').on('click', '.add', function () {
    // console.log($(this).attr('id'));
    var addEn = $(this).siblings('form').children('input');
    var name = addEn.val();
    var init = addEn.next().val();
    var ac = addEn.next().next().val();
    var hp = addEn.next().next().next().val();
    $.post('/redirect/enemy/' + name +  '/' +  hp +  '/' + ac +  '/' + init, function () {});
    $('#added').show();
    $(this).parent().hide(1000);
    $('#added').fadeOut(3000);
    console.log($(this).parent().parent().sibling('span'));

  });

});
