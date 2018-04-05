// $('#search').keyup(function() {
//   var regex = new RegExp($('#search').val(), "i");
//   var rows = $('table tr:gt(0)');
//   rows.each(function (index) {
//     title = $(this).children("#title").html()
//     if (title.search(regex) != -1) {
//       $(this).show();
//     } else {
//       $(this).hide();
//     }
//   });
// });
//
//
// var allRows = $("tr");
// $("input#search").on("keydown keyup", function() {
//   allRows.hide();
//   $("tr:contains('" + $(this).val() + "')").show();
// }

var  hidden = true;
var curReagentId = 0;

$(document).ready(function() {
  $("#reagents-table").tablesorter();

  // $('#datetimepicker1').datetimepicker();
  // $('#datetimepicker2').datetimepicker();
  $('.datetimepicker').datetimepicker({
    format:'YYYY-MM-DD HH:mm:ss',
  });

  $( ".form-container" ).hide();
  $( "#form-toggle" ).click(function() {
    if(hidden) {
      $( ".form-container" ).show();
      hidden = !hidden;
      $('#form-toggle').text('Inchide formular');
    } else {
      $( ".form-container" ).hide();
      hidden = !hidden;
      $('#form-toggle').text('Deschide formular');
    }
  });

});

$('input[type="submit"]').click(function(e) {
  e.preventDefault();
  if( $('input[type="submit"]').val() == 'Actualizare') {
    $('.form-container').attr('action', `reagent/${curReagentId}/update`);
  }
  $('.form-container').submit();
});

$('.btn-clone').click( function(event) {
  event.preventDefault();
      $('input[type="submit"]').val('Salvare');
  let url = $(this).attr('href');
  $.get(url).then(function(response) {
    $('.form-container').show();
    $('#form-toggle').text('Inchide formular');
    hidden = false;
    $("html, body").animate({
      scrollTop: 0,
    }, 500);

    for(let elem in response) {
      if($(`[name="${elem}"]`).length) {
        $(`[name="${elem}"]`).val(response[elem]);
      }
    }

    $('.selectpicker').selectpicker('refresh');

  }, function() {
    console.log("error getting " + url);
  });
});

$('.btn-edit').click( function(event) {
  event.preventDefault();
  let url = $(this).attr('href');
  curReagentId = url.split('/')[2];
  $.get(url).then(function(response) {
    $('.form-container').show();
    $('#form-toggle').text('Inchide formular');
    hidden = false;
    $("html, body").animate({
      scrollTop: 0,
    }, 500);
    $('input[type="submit"]').val('Actualizare');

    for(let elem in response) {
      if($(`[name="${elem}"]`).length) {
        $(`[name="${elem}"]`).val(response[elem]);
      }
    }

    $('.selectpicker').selectpicker('refresh');

  }, function() {
    console.log("error getting " + url);
  });
});
