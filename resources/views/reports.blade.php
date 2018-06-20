@extends('layouts.master')

@section('content')


<div id="page-wrap">

  <div class="container">
    <h3 class="text-center">
      Detalii reagent eliberat
      {{ $order->reagentTitle($order->reagent_id) }}
      [{{ $order->reagentCode($order->reagent_id) }}]
    </h3>


    <div class="container" style="max-width: 600px;">
      <br>
      <div class="box-error"></div>

      <form class="form-container" id="form-reagents" method="post" action="reports/store/">

        <label for="qtyOrder" class="grey-text"><span class="red-star">*</span>
          <span id="code_text">Cantitate</span></label>
        <input type="text" id="qtyOrder" class="form-control" name="taken_quantity">

        <label for="select_person" class="grey-text"><span class="red-star">*</span>
           <span id="producer_text">Instalat de persoana</span></label>
        <select class="form-control selectpicker" id="select_person" name="person_id" data-live-search="true">
          <option value="default" selected disabled>----- Selectati persoana -----</option>
          @php
           $people = \App\Person::all();
          @endphp

          @foreach ($people as $person)
            <option data-tokens="{{ $person->fullname }}" value="{{ $person->id }}">
              {{ $person->fullname }}
            </option>
          @endforeach
        </select>


        <label for="datetimepicker_start" class="grey-text"><span class="red-star">*</span>
           <span id="start_date">Data instalarii</span></label>
        <div class='input-group date' id='datetimepicker_start'>
            <input type='text' class="form-control datetimepicker" name="start_date"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>

        <label for="datetimepicker_end" class="grey-text"><span class="red-star">*</span>
           <span id="end_date">Data finalizarii</span></label>
        <div class='input-group date' id='datetimepicker_end'>
            <input type='text' class="form-control datetimepicker" name="end_date"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>

        <br>
        <div class="text-center mt-4">
            <input class="btn btn-primary" type="submit" id="submit-reagent" value="Salvare">
            <button class="btn btn-default btn-cancel" type="button">Anulare</button>
        </div>

      </form>

    </div>
  </div>

</div>

@endsection
