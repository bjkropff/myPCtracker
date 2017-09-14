function next() {
  $('button#next').on('click', function (event) {
    console.log('this thing');

    var shiftItem = list[0];
    list.shift();
    list.push(shiftItem);

    $('#testlist').children('li ').hide();

    for (var i = 0; i < list.length; i++) {
      $('ul#testlist').append($('<li> <button class="btn btn-primary notSelected" id="' + list[i].id + '" name="select">' + list[i].name + '</button></br>Init: '  + list[i].init + " AC: "  + list[i].ac + " | HP: " + list[i].hp  +  ' <button class="btn btn-danger" name="delete">X</button></li>'
      ));
    }
  });
}
