@extends('layouts.master')

@section('content')


<div id="page-wrap">

  <div class="container-fluid" style="margin: 5px;">
    <button class="btn" id="form-toggle" name="button">Deschide formular</button>
  </div>


  <div class="container" style="max-width: 600px;">


    <form class="form-container" method="post" action="order/store/"
      style="display: none">

      {{ csrf_field() }}
      <br>
      <p class="h4 text-center mb-4 add-new">Eliberare noua</p>
      <br>


      <div class="row">
        <div class="form-group">
          <div class='col-sm-6'>
            <label for="selectpicker" class="grey-text">Persoana</label>
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
            <label for="selectpicker" class="grey-text">Producator</label>
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

      <div class="row" id="display-reagent">
        <div class="form-group">
          <div class='col-sm-6'>
            <label for="selectpicker" class="grey-text">Reagent</label>
            <select class="form-control selectpicker" id="select-reagent" name="reagent_id" data-live-search="true">
              {{-- <option value="default" selected disabled>----- Selectati reagent -----</option> --}}
            </select>
          </div>

          <div class='col-sm-6'>
            <div class='input-group date' id='datetimepicker2'>
              <label for="defaultExpire" class="grey-text">Data Eliberarii</label>
                <input type='text' class="form-control datetimepicker" name="hand"/>
                {{-- <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span> --}}
            </div>
          </div>

        </div>
      </div>

      <br>

      <div class="text-center mt-4">
        <button class="btn btn-primary btn-select" type="button">Selectare</button>
          <button class="btn btn-default btn-cancel" type="button">Anulare</button>
      </div>
    </form>
  </div>


  @if (isset($orders) && $orders->count() != 0)

    <table id="orders-table" class="tablesorter records-table">
      <thead>
        <tr>
          <th>Cod reagent</th>
          <th>Denumire reagent</th>
          <th>Persoana</th>
          <th>Data eliberarii</th>
          <th>Actiuni</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Cod reagent</th>
          <th>Denumire reagent</th>
          <th>Persoana</th>
          <th>Data eliberarii</th>
          <th>Actiuni</th>
        </tr>
      </tfoot>

      <tbody>
        {{-- @foreach ($orders as $order)
          <tr>
            <td> {{ $order->reagentCode($order->reagent_id) }} </td>
            <td> {{ $order->reagentTitle($order->reagent_id) }} </td>
            <td> {{ $order->person($order->person_id) }} </td>
            <td> {{ $order->created_at }} </td>
            <td class="clearfix" style="min-width: 150px;">
              <a class="btn btn-warning btn-xs btn-edit" href="/order/{{ $order->id }}/edit">Edit</a>
              <a class="btn btn-danger btn-xs btn-delete" href="/order/{{ $order->id }}/delete">Delete</a>
              <a class="btn btn-primary btn-xs btn-clone" href="/order/{{ $order->id }}/edit">Clone</a>
            </td>
          </tr>

        @endforeach --}}

      </tbody>

    </table>
  @else
    <h3 style="text-align:center;">Empty database</h3>
  @endif

  </div>

@endsection
