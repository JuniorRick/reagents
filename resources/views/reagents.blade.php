@extends('layouts.master')

@section('content')


<div id="page-wrap">

  <div class="container-fluid" style="margin: 5px;">
    <button class="btn" id="form-toggle" name="button">Deschide formular</button>
  </div>


  <div class="container" style="max-width: 600px;">


    <form class="form-container" method="post" action="reagent/store/"
      style="display: none">

      {{ csrf_field() }}
      <br>
      <p class="h4 text-center mb-4 add-new">Adaugati o inregistrare noua</p>
      <br>


      <div class="row">
        <div class="form-group">
          <div class='col-sm-6'>
            <label for="selectpicker" class="grey-text">Producator</label>
            <select class="form-control selectpicker" id="selectpicker" name="producer_id" data-live-search="true">
              <option data-tokens="ketchup mustard" value="default" selected disabled>----- Selectati producatorul -----</option>
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

          <div class='col-sm-6'>
            <label for="datetimepicker1" class="grey-text">Data factura</label>
            <div class='input-group date' id='datetimepicker1'>
                <input type='text' class="form-control datetimepicker" name="receive_date"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
          </div>
        </div>
      </div>

      <!-- Default input email -->
      <label for="defaultCodIntern" class="grey-text">Cod Intern</label>
      <input type="text" id="defaultCodIntern" class="form-control" name="code">

      {{-- <br> --}}

      <!-- Default input password -->
      <label for="defaultDenumire" class="grey-text">Denumire</label>
      <input type="text" id="defaultDenumire" class="form-control" name="name">

      {{-- <br> --}}

      <!-- Default input password -->
      <label for="defaultCodLot" class="grey-text">Cod Lot</label>
      <input type="text" id="defaultCodLot" class="form-control" name="lot">


      <label for="defaultExpire" class="grey-text">Data Expirarii</label>
      <div class="row" id="defaultExpire">
        <div class="form-group">
          <div class='col-sm-12'>
            <div class='input-group date' id='datetimepicker2'>
                <input type='text' class="form-control datetimepicker" name="expire"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
          </div>
        </div>
      </div>

      <br>

      <div class="text-center mt-4">
          <input class="btn btn-primary" type="submit" value="Salvare">
          <button class="btn btn-default btn-cancel" type="button">Anulare</button>
      </div>
    </form>
  </div>


  @if (isset($reagents) && $reagents->count() != 0)

    <table id="reagents-table" class="tablesorter records-table">
      <thead>
        <tr>
          <th>Producator</th>
          <th>Data primirii</th>
          <th>Cod intern</th>
          <th>Denumire</th>
          <th>Cod Lot</th>
          <th>Data expirarii</th>
          <th>Actiuni</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Producator</th>
          <th>Data primirii</th>
          <th>Cod intern</th>
          <th>Denumire</th>
          <th>Cod Lot</th>
          <th>Data expirarii</th>
          <th>Actiuni</th>
        </tr>
      </tfoot>

      <tbody>
        @foreach ($reagents as $reagent)

          <tr>
            <td>{{ $reagent->producer() }}</td>
            <td>{{ $reagent->receive_date}}</td>
            <td>{{ $reagent->code }}</td>
            <td>{{ $reagent->name }}</td>
            <td>{{ $reagent->lot}}</td>
            <td>{{ $reagent->expire}}</td>
            <td class="clearfix" style="min-width: 150px;">
              <a class="btn btn-warning btn-xs btn-edit" href="/reagent/{{ $reagent->id }}/edit">Edit</a>
              <a class="btn btn-danger btn-xs btn-delete" href="/reagent/{{ $reagent->id }}/delete">Delete</a>
              <a class="btn btn-primary btn-xs btn-clone" href="/reagent/{{ $reagent->id }}/edit">Clone</a>
            </td>
          </tr>

        @endforeach

      </tbody>

    </table>
  @else
    <h3 style="text-align:center;">Empty database</h3>
  @endif

  </div>

@endsection
