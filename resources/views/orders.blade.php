@extends('layouts.master')

@section('content')


<div id="page-wrap">

  {{-- <div class="container-fluid" style="margin: 5px;">
    <button class="btn" id="form-toggle" name="button">Deschide formular</button>
  </div> --}}


  <div class="container" style="max-width: 600px;">

    <div class="box-error"></div>

    <form method="post" action="order/store/">

      {{-- {{ csrf_field() }} --}}
      <br>
      <p class="h4 text-center mb-4 add-new">Eliberare noua</p>
      <br>


      <div class="row">
        <div class="form-group">
          <div class='col-sm-6'>
            <label for="selectpicker" class="grey-text"><span class="red-star">*</span> Persoana</label>
            <select class="form-control selectpicker" id="select-person" name="person_id" data-live-search="true">
              <option value="default" selected disabled>----- Selectati persona -----</option>
              @php
               $persons = \App\Person::all();
              @endphp

              @foreach ($persons as $person)
                <option data-tokens="{{ $person->fullname }}" value="{{ $person->id }}">
                  {{ $person->fullname }}
                </option>
              @endforeach
            </select>
          </div>

          <div class='col-sm-6' id="display-producer">
            <label for="selectpicker" class="grey-text"><span class="red-star">*</span> Producator</label>
            <select class="form-control selectpicker" id="select-producer" data-live-search="true">
              <option value="default" selected disabled>----- Selectati producatorul -----</option>
              @php
               $producers = \App\Producer::all();
              @endphp

              @foreach ($producers as $producer)
                <option data-tokens="{{ $producer->name }}" value="{{ $producer->id }}">
                  {{ $producer->name }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <br>

      <div class="row" id="display-reagent" style="display: none">
        <div class="form-group">
          <div class='col-sm-6'>
            <label for="selectpicker" class="grey-text"><span class="red-star">*</span> Reagent</label>
            <select class="form-control selectpicker" id="select-reagent" name="reagent_id" data-live-search="true">
              {{-- <option value="default" selected disabled>----- Selectati reagent -----</option> --}}
            </select>
          </div>

          <div class='col-sm-6'>
            <div class='input-group date' id='datetimepicker2'>
              <label for="defaultExpire" class="grey-text"><span class="red-star">*</span> Data Eliberarii</label>
                <input type='text' id="time" class="form-control datetimepicker" name="handed_date"/>
            </div>
          </div>
        </div>
      </div>

      <br>
      <div class="text-center mt-4">
        <button class="btn btn-primary btn-select" type="button">Selectare</button>
          <button class="btn btn-default btn-clear" type="button">Anulare selectii</button>
      </div>

    </form>
  </div>

  {{-- TODO display errors here --}}

  <div id="orders-table" class="orders-new" style="display: none;">
    <table  class="tablesorter records-table">
      <thead>
        <tr>
          {{-- <th>Nr.</th> --}}
          <th>Cod reagent</th>
          <th>Denumire reagent</th>
          <th>Persoana</th>
          <th>Data eliberarii</th>
          <th>Actiuni</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          {{-- <th>Nr.</th> --}}
          <th>Cod reagent</th>
          <th>Denumire reagent</th>
          <th>Persoana</th>
          <th>Data eliberarii</th>
          <th>Actiuni</th>
        </tr>
      </tfoot>

      <tbody>
        {{-- selected orders goes here --}}
      </tbody>

    </table>

    <div class="container-fluid" style="margin: 5px; text-align: center;">
      <button class="btn btn-lg btn-primary" id="btn-store-orders" name="button">Eliberare</button>
    </div>
  </div>


  </div>

@endsection
