@extends('layouts.master')

@section('content')


<div id="page-wrap">

@can('create')
  <div class="container-fluid" style="margin: 5px;">
    <button class="btn" id="form-toggle" name="button">Deschide formular</button>
  </div>
@endcan

  <div class="container" style="max-width: 600px;">


    <form class="form-container" id="form-reagents" method="post" action="reagent/store/"
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
          <input class="btn btn-primary" type="submit" id="submit-reagent" value="Salvare">
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
          <th>Stare</th>
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
          <th>Stare</th>
          <th>Actiuni</th>
        </tr>
      </tfoot>

      <tbody>
        @foreach ($reagents as $reagent)

          <tr>
            <td>{{ $reagent->producer() }}</td>
            <td>{{ explode(" ", $reagent->receive_date)[0]}}</td>
            <td>{{ $reagent->code }}</td>
            <td>{{ $reagent->name }}</td>
            <td>@if($reagent->lot == '') - @else {{ $reagent->lot}} @endif</td>
            <td>{{ explode(" ", $reagent->expire)[0]}}</td>
            <td>{{ $reagent->is_handed ? 'Eliberat' :  'In stoc' }}</td>
            <td class="clearfix" style="min-width: 150px;">
              @can('create')
                <a class="btn btn-warning btn-xs btn-edit" href="/reagent/{{ $reagent->id }}/edit">Edit</a>
                <a class="btn btn-primary btn-xs btn-clone" href="/reagent/{{ $reagent->id }}/edit">Clone</a>
              @endcan
              @can('delete')
                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
                data-target="#modal-delete{{ $reagent->id}}" style="margin: 5px 0 0 5px;">Delete</button>
              @endcan
            </td>


            <div id="modal-delete{{ $reagent->id }}" class="modal fade" role="dialog" style="z-index:9999;">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ $reagent->name }} </h4>
                  </div>
                  <div class="modal-body">
                    <p>
                      <h1 style="color: #f00">Atentie!</h1>
                      <h2>La stergerea inregistrarii  <strong>{{ $reagent->code }}</strong>
                        vor fi sterse toate referintele acestei inregisrari
                      </h2>
                    </p>
                  </div>
                  <div class="modal-footer">
                    <a class="btn btn-danger btn-delete" href="/reagent/{{ $reagent->id }}/delete">Sterge</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>
          </tr>

        @endforeach

      </tbody>

    </table>
  @else
    <h3 style="text-align:center;">Empty database</h3>
  @endif

  </div>

@endsection
