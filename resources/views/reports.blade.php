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

      <form class="form-container" id="form-reagents" method="post" action="/reports/store/">
        {{ csrf_field() }}

        <input type="hidden" name="order_id" value="{{ $order->id }}">

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
          <input class="btn btn-primary" type="submit" id="submit-report" value="Salvare">
          <button class="btn btn-default btn-cancel" type="button">Anulare</button>
        </div>

      </form>


      @if (isset($reports) && $reports->count() > 0)

        <h3 class="text-center">
          Detalii inregistrate
        </h3>

        @include('layouts.error')

        <table id="reports-table" class="tablesorter records-table">
          <thead>
            <tr>
              <th>Cantitate</th>
              <th>Persoana</th>
              <th>Data instalarii</th>
              <th>Data finalizarii</th>
              <th>Actiune</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Cantitate</th>
              <th>Persoana</th>
              <th>Data instalarii</th>
              <th>Data finalizarii</th>
              <th>Actiune</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach ($reports as $report)
              <tr>
                <td>{{ $report->taken_quantity}}</td>
                <td>{{ $report->person($report->person_id)}}</td>
                <td>{{ $report->start_date }}</td>
                <td>{{ $report->end_date }}</td>
                <td class="clearfix" style="min-width: 150px;">
                  @can('create')
                    <a class="btn btn-warning btn-xs btn-edit" href="/report/{{ $report->id }}/edit">Edit</a>
                    <a class="btn btn-primary btn-xs btn-clone" href="/report/{{ $report->id }}/edit">Clone</a>
                  @endcan
                  @can('delete')
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
                    data-target="#modal-delete{{ $report->id}}" style="margin: 5px 0 0 5px;">Delete</button>
                  @endcan
                </td>


                <div id="modal-delete{{ $report->id }}" class="modal fade" role="dialog" style="z-index:9999;">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Stergere ireversibila a inregistrarii</h4>
                      </div>
                      <div class="modal-body">
                        <p>
                          <h1 style="color: #f00">Atentie!</h1>
                          <h2>Sunteti siguri ca doriti sa stergeti
                            aceasta inregistrate?
                          </h2>
                        </p>
                      </div>
                      <div class="modal-footer">
                        <a class="btn btn-danger btn-delete" href="/report/{{ $report->id }}/delete">Sterge</a>
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
  </div>

</div>

@endsection
