
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
var curReportId = 0;
var curUserId = 0;
var selectedReagents = [];

$(document).ready(function() {

  if(typeof sort_by !== 'undefined') {
    $("#reagents-table").tablesorter( {sortList: [[0,0], [sort_by,0]]});
  }

  $('.scroll-up').click( function() {
    $("html, body").animate({
      scrollTop: 0,
    }, 500);
  });

  $('.scroll-down').click( function() {
    $("html, body").animate({
      scrollTop: $(document).height(),
    }, 500);
  });

  //enable table sorter
  $("#orders-table").tablesorter();
  $('.orders-new').hide();
  $('#btn-store-orders').prop('disabled', false);
  //reset pickers

  $('#select_person').selectpicker('val', 'default');
  $('#select_producer').selectpicker('val', 'default');

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

$(".selectpicker").change(function() {
    $('.btn-group.bootstrap-select.form-control').removeClass('open');
});


//submit the form to add new reagent
$('#submit-reagent').click(function(e) {
  e.preventDefault();
  $('span').css('color', '#000');

  var url =  `/reagents/all`;
  $.get(url).then(function(response) {
    if( $('input[type="submit"]').val() == 'Actualizare') {
      $('.form-container').attr('action', `/reagent/${curReagentId}/update`);
    }

    var errorFound = false;
    if($('#select_producer').find("option:selected").val() == 'default' ||
      $('#select_producer').find("option:selected").val().length == 0) {

      $('#producer_text').css('color', "red");
      errorFound = true;
    }
    if($("#datetimepicker1").find("input").val().length == 0) {
      $('#receiveDate_text').css('color', 'red');
      $('.box-error').text("eroare de introducere a datelor");
      errorFound = true;
    }

    if($('#defaultDenumire').val().length == 0) {
      $('.box-error').text("eroare de introducere a datelor");
      $('#name_text').css('color', 'red');
      errorFound = true;
    }

    if( $('#defaultQty').val().length == 0 || isNaN(($('#defaultQty').val()))) {

      $('#qty_text').css('color', 'red');
      $('.box-error').text("eroare de introducere a datelor");
      errorFound = true;
    }

    if($("#datetimepicker2").find("input").val().length == 0) {
      $('#expireDate_text').css('color', 'red');
      $('.box-error').text("eroare de introducere a datelor");
      errorFound = true;
    }

      if($('#defaultCodIntern').val().length == 0) {
        $('.box-error').text("eroare de introducere a datelor");
        $('#code_text').css('color', 'red');
        errorFound = true;
      } else {
        $.each(response, function(i, elem) {
          if(elem.code == $('#defaultCodIntern').val() &&
            $('input[type="submit"]').val() != 'Actualizare') {
            // $('#defaultCodIntern').css('color', 'red');
            $('#code_text').css('color', 'red');
            errorFound = true;
            $('.box-error').html("eroare de introducere a datelor"
            + "<br>cod intern trebuie sa fie unic");
          }
        });
      }
      if(errorFound) {
        $('.box-error').show();
        return;
      } else {
        $('.form-container').submit();
      }
  }, function() {
  console.log("error getting " + url);
  });



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

$('#submit-report').click(function(e) {
  e.preventDefault();
  if( $('input[type="submit"]').val() == 'Actualizare') {
    $('.form-container').attr('action', `/report/${curReportId}/update`);
  }
  $('.form-container').submit();
});

$('#submit-user').click(function(e) {
  e.preventDefault();
  if( $('input[type="submit"]').val() == 'Actualizare') {
    $('.form-container').attr('action', `/user/${curReportId}/update`);
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
      if(Date.parse(response[elem])){
        $(`[name="${elem}"]`).val(response[elem].toString().split(' ')[0]);
      } else {
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
  curReportId = url.split('/')[2];
  curUserId = url.split('/')[2];

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
        //TODO remove time from date
        if(false){
          $(`[name="${elem}"]`).val(response[elem].toString().split(' ')[0]);
        } else {
          $(`[name="${elem}"]`).val(response[elem]);
        }
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
  $('.selectpicker').val('default');
  $('.selectpicker').selectpicker('refresh');
  $('.form-container')[0].reset();
  $('input[type="submit"]').val('Salvare');
  // $('.form-container').hide();
  $('#form-toggle').text('Deschide formular');
  hidden = true;
  $('.form-container').hide();
});


//clear all selections
$('.btn-clear').click(function() {
  cancelSelection(this);
});

function cancelSelection(self) {
  $('tbody').find('tr').remove();
  $('#orders-table').hide();
  selectedReagents = [];
 $('#select-reagent').find('option').remove();
 let url = `/reagents/` + $(self).val();
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
}

//display reagents by producer on producer selected
$('#select-producer').change(onSelectProducer);

var i = 0;

function onSelectProducer() {
    $('#display-reagent').show();
    $('#select-reagent').find('option').remove();
    let producer_id = $(this).val();
    $('.btn-clear').val(producer_id);
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
}

//add reagent to the list
$('.btn-select').click(function() {
  const reagent_id = $('[name="reagent_id"]').val();
  const url = `/reagent/${reagent_id}`;
  var person_id = $('#select-person').val();

  // console.log($('#select-producer').val());

  if(person_id == null || $('[name="handed_date"]').val() == "" ||
    $('#select-reagent').val() == 'default' || $('#select-producer').val() == null) {
    $('.box-error').show();
    $('.box-error').text("Toate campurile sunt oblicatorii");

    setTimeout(function() {
      $('.box-error').hide();
    }, 4000);

    return;
  }


  $('#orders-table').show();
  $('.btn-select').prop('disabled', true);

  i++;
  $.get(url).then(function(response) {
    // console.log(response);
    $('tbody').append($('<tr>')
      .attr('id', response.id + "_" + i)
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
          .attr('value', response.id + "_" + i)
        )
      )
    );

    $(`#select-reagent option[value=${reagent_id}]`).remove();
    $('#select-reagent').selectpicker('refresh');
    $('#btn-store-orders').text(`Eliberare (${ $('tbody').children().length })`);
    selectedReagents.push({
      id: response.id + "" + i,
      reagent_id: reagent_id,
      person_id: person_id,
      handed_date:  $('#time').val().split(' ')[0],
      order_quantity: response.quantity,
      state: 0,
     });


    //eliminate reagent from the list
    $('.btn-remove-selection').on('click', function() {
      let id = $(this).val();
      let reagent_id = id.split('_')[0];
      console.log(reagent_id);
      let url = `/reagent/${reagent_id}`;
      $.get(url).then(function(response) {

          $('#select-reagent').append($('<option>', {
            dataTokens: response.name,
            value: response.id,
            text: `[${response.code}] ${response.name}`,
          }));

        $('.selectpicker').selectpicker('refresh');
      }, function() {
        console.log("error getting " + url);
      });



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


$('#btn-store-orders').click( function() {
  $(this).prop('disabled', true);

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var reagentsToStore = {};
    var i = 0;
    for(let reagent of selectedReagents) {
      delete reagent.id;
      reagentsToStore[i++] = reagent;

      if(reagent.person_id == "" || reagent.reagent_id == "" ||
        reagent.handed_date == "") {
          $('.box-error').show();
          $('.box-error').text("Toate campurile sunt oblicatorii");
        }

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

  $('#orders-active').click(function() {
    allRows.hide();
    $('thead tr').show();
    $('tfoot tr').show();
    $("tr:contains('Activ')").show();
  });

  function viewFinished() {
      allRows.hide();
      $('thead tr').show();
      $('tfoot tr').show();
      $("tr:contains('Finisat')").show();
    }
  function viewActive() {
      allRows.hide();
      $('thead tr').show();
      $('tfoot tr').show();
      $("tr:contains('Activ')").show();
    }
  function viewAll() {
      allRows.show();
    }
