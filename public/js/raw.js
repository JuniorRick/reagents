
$.expr[":"].contains = $.expr.createPseudo(function(arg) {
    return function( elem ) {
        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});


var allRows = $("tr");
$("input#search").on("keydown keyup", function() {
  allRows.hide();
  $('thead tr').show();
  $('tfoot tr').show();
  $("tr:contains('" + $(this).val() + "')").show();
});

var hidden = true;
var curReagentId = 0;
var curProducerId = 0;
var curPersonId = 0;
var selectedReagents = [];

$(document).ready(function() {
  //enable table sorter

  $("#reagents-table").tablesorter();
  $("#orders-table").tablesorter();
  $('.orders-new').hide();
  $('#btn-store-orders').prop('disabled', false);
  //reset pickers

  $('.selectpicker').selectpicker('val', 'default');

  //create date picker
  $('.datetimepicker').datetimepicker({
    format:'YYYY-MM-DD',
  });

  lastReagentsVals();
  //show/hide form
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

  //hide form after submit
  $('#display-reagent').hide();
});

// $('#form-reagents').click(function(e) {
//   e.preventDefault();
// });


$(".selectpicker").change(function() {
    $('.btn-group.bootstrap-select.form-control').removeClass('open');
});

//submit the form
$('#submit-reagent').click(function(e) {
  e.preventDefault();
  if( $('input[type="submit"]').val() == 'Actualizare') {
    $('.form-container').attr('action', `reagent/${curReagentId}/update`);
  }
  $('.form-container').submit();
});

$('#submit-person').click(function(e) {
  e.preventDefault();
  if( $('input[type="submit"]').val() == 'Actualizare') {
    $('.form-container').attr('action', `person/${curPersonId}/update`);
  }
  $('.form-container').submit();
});

$('#submit-producer').click(function(e) {
  e.preventDefault();
  if( $('input[type="submit"]').val() == 'Actualizare') {
    $('.form-container').attr('action', `producer/${curProducerId}/update`);
  }
  $('.form-container').submit();
});

//clone the record
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


//edit the record
$('.btn-edit').click( function(event) {
  event.preventDefault();
  let url = $(this).attr('href');
  curReagentId = url.split('/')[2];
  curProducerId = url.split('/')[2];
  curPersonId = url.split('/')[2];

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

//refresh form
$('.btn-cancel').click(function () {
  // location.reload();
  $('#selectpicker').val('default');
  $('#selectpicker').selectpicker('refresh');
  $('.form-container')[0].reset();
  $('input[type="submit"]').val('Salvare');
  $('.form-container').hide();
  $('#form-toggle').text('Deschide formular');
  hidden = true;
});


//clear all selections
$('.btn-clear').click(function() {
  $('tbody').find('tr').remove();
  $('#orders-table').hide();
  selectedReagents = [];
});


//display reagents by producer on producer selected
$('#select-producer').change(function() {
  $('#display-reagent').show();
  $('#select-reagent').find('option').remove();
  let producer_id = $(this).val();
  let url = `/reagents/${producer_id}`;
  $.get(url).then(function(response) {
    $('#select-reagent').append($('<option>', {
      value: 'default',
      text: '----- Selectati reagent -----',
    }));
    $.each(response, function (i, elem) {
      $('#select-reagent').append($('<option>', {
        dataTokens: elem.name,
        value: elem.id,
        text: `[${elem.code}] ${elem.name}`,
      }));
    });

    $('.selectpicker').selectpicker('refresh');
  }, function() {
    console.log("error getting " + url);
  });
});
var i = 0;

//add reagent to the list
$('.btn-select').click(function() {
  $('.btn-select').prop('disabled', true);
  const reagent_id = $('[name="reagent_id"]').val();
  const url = `/reagent/${reagent_id}`;
  $('#orders-table').show();
  var person_id = $('#select-person').val();

  i++;
  $.get(url).then(function(response) {
    // console.log(response);
    $('tbody').append($('<tr>')
      .attr('id', response.id + "" + i)
      .append($('<td>')
        .text(response.code)
      ).append($('<td>')
        .text(response.name)
      ).append($('<td>')
        .text($(`#select-person option[value="${person_id}"]`).text())
        .attr('val', $('#select-person').val())
      ).append($('<td>')
        .text($('[name="handed_date"]').val())
      ).append($('<td>')
        .append($('<button>')
          .text('Eliminare')
          .attr('class','btn btn-danger btn-xs btn-remove-selection')
          .attr('value', response.id + "" + i)
        )
      )
    );

    $(`#select-reagent option[value=${reagent_id}]`).remove();
    $('#select-reagent').selectpicker('refresh');

    $('#btn-store-orders').text(`Eliberare (${ $('tbody').children().length })`);
    selectedReagents.push({id: response.id + "" + i, reagent_id: reagent_id,
      person_id: person_id, created_at:  $('#time').val() });


    //eliminate reagent from the list
    $('.btn-remove-selection').on('click', function() {
      let id = $(this).val();
      $(`#${id}`).remove();
      selectedReagents = selectedReagents.filter(function(el) {
        return el.id !== id;
      });
      var reagentsCounter = $('tbody').children().length
      $('#btn-store-orders').text(`Eliberare (${ reagentsCounter })`);
      if(reagentsCounter == 0) {
          $('.orders-new').hide();
      }
    });
    $('.btn-select').prop('disabled', false);

  }, function() {
    console.log("error getting " + url);
  });
  $('.selectpicker').selectpicker('refresh');
});


//TODO error ckeck
$('#btn-store-orders').click( function() {
  $(this).prop('disabled', true);

    console.log('storing data...');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var reagentsToStore = {};
    var i = 0;
    for(let reagent of selectedReagents) {
      reagent.handed_date = $('[name="handed_date"]').val().split(' ')[0];
      delete reagent.id;
      reagentsToStore[i++] = reagent;
    }
    console.log(reagentsToStore);
    $.ajax({
      url: '/orders/bulkstore',
      type: 'POST',
      data: reagentsToStore,
      success: function(response, textStatus, jqXHR) {
        console.log("success");
      },
      error: function(jqXHR, textStatus, errorThrown){
        console.log(textStatus + "  " + errorThrown);
        console.log(this.data);
      }
    })
    .done(function() {
      window.location.href=window.location.href;
    });

  });

  $('body').change(function() {
    if($('.orders-new tbody').children().length > 0) {
      $('.orders-new').show();
    } else {
      $('.orders-new').hide();
    }
  });
