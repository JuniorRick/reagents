<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Document</title>

  {{--
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{!! asset('css/default.css')!!}">
  <link rel="stylesheet" href="{!! asset('css/table.css')!!}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js" charset="utf-8"></script>
</head>
  <style media="screen">
    .flash-message {
        position: fixed;
        top: 2vh;
        left: 3vw;
        z-index: 9999;
        border-radius: 3px;
        padding: 15px;
    }
    .success, .update {
      background: #65aa35;
      color: #fff;
    }
    .delete {
      background: #f2ff5e;
      color: #000;
    }
    .error {
      background: #f00;
      color: #000;
    }
  </style>
<body>

    @if(\Session::has('success') || \Session::has('bulk_success'))
      <div class="flash-message success">
        {{ \Session::get('success') }}
        {{ \Session::get('bulk_success') }}
      </div>
    @elseif (\Session::has('delete'))
      <div class="flash-message delete">
        {{ \Session::get('delete') }}
      </div>
    @elseif (\Session::has('update'))
      <div class="flash-message update">
        {{ \Session::get('update') }}
      </div>
    @elseif (\Session::has('error'))
      <div class="flash-message error">
        {{ \Session::get('error') }}
      </div>
    @endif


  @include('layouts.nav')

  @yield('content')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.30.1/js/jquery.tablesorter.min.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.0/moment.min.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" charset="utf-8"></script>
  <script src="{!! asset('js/jquery.url.js') !!}" charset="utf-8"></script>
  <script src="{!! asset('js/raw.js') !!}" charset="utf-8"></script>
  <script type="text/javascript">
    setTimeout( function() {
      $('.flash-message').hide();
    }, 6000);

    $(function(){
      var urlArr = jQuery.url.attr("source").split('/');
      var $page = '/' + urlArr[urlArr.length - 1];
      var $page2 = '/' + urlArr[urlArr.length - 2] + '/' + urlArr[urlArr.length - 1];
      $('#demo-bar-buttons a').each(function(){
          var $href = $(this).attr('href');
          if ( ($href == $page) || ($href == $page2) || ($href == '') ) {
              $(this).addClass('on');
          } else {
              $(this).removeClass('on');
          }
      });
    });
  </script>

  @if (\Session::has('producer_id') && \Session::has('receive_date'))
    <script type="text/javascript">
      function lastReagentsVals() {
        $('#form-reagents').show();
        hidden = false;
        $('#form-toggle').text('Inchide formular');
        $('select[name=producer_id]').val({{ \Session::get('producer_id') }});
        $('.selectpicker').selectpicker('refresh');
        $('#datetimepicker1 input').val('{{ \Session::get('receive_date') }}'.split(" ").join('-'));
      }
    </script>
  @else
    <script type="text/javascript">
      function lastReagentsVals() {}
    </script>
  @endif

</body>

</html>
