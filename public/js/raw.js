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


$(document).ready(function() {
  $("#reagents-table").tablesorter();

  // $('#datetimepicker1').datetimepicker();
  // $('#datetimepicker2').datetimepicker();
  $('.datetimepicker').datetimepicker({
    format:'YYYY-MM-DD HH:mm:ss',
  });

  $( ".form-container" ).hide();
  let hidden = true;
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
