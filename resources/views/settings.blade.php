@extends('layouts.master')


@section('content')
<style media="screen">
  legend {
    color: rgb(55, 77, 119);
    font-style: italic;
  }
  .box {
    border: 1px solid black;
    padding: 20px;
    margin: 10px;
  }
  form {
    margin: 10px;
  }
</style>

<div id="page-wrap">

  <div class="container menu-settings">
   <ul>
     <li><a href="#users-settings">Setari utilizatori</a></li>
     <li><a href="#roles-settings">Setari roluri si permisiuni</a></li>
     <li><a href="#design-settings">Setari reagenti</a></li>
     <li><a href="#logs">Logs</a></li>

   </ul>
  </div>

  <div class="container" id="settings" >
    @php
      $users = \App\User::all();
    @endphp
    <div id="users-settings">@include('settings.userSettings')</div>
    <div id="roles-settings">@include('settings.roleSettings')</div>
    <div id="design-settings">@include('settings.designSettings')</div>
    <div id="logs">@include('settings.logs')</div>

  </div>

</div>
<script type="text/javascript">
  $('#select_column_sort').selectpicker('val', '{{$settings->reagent_sort_by}}');

  $('#settings > div').hide();
  $($('.menu-settings > ul > li > a').first().attr('href')).show();

  $('.menu-settings a').click( function() {
    let id = $(this).attr('href');
    $('#settings > div').hide();
    $(id).show();
  });

</script>
@endsection
