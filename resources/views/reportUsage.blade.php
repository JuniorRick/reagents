@extends('layouts.master')

@section('content')


<div id="page-wrap">

  @php
    $counter = 0;
  @endphp
  @if (true)

    <div class="clearfix">
      <h3 class="text-center">
        Raport laborator<br><br>
        <a href="/report/xlsx" class="btn btn-primary">Descarca (.xlsx)</a>
      </h3>

    </div>
    <table id="orders-table" class="tablesorter records-table">
      <thead>
        <tr >
          <th data-text="Nr.">Nr.</th>
          <th data-text="Cod reagent">Cod reagent</th>
          <th data-text="Producator">Producator</th>
          <th data-text="Denumire reagent">Denumire reagent</th>
          <th data-text="Ref">Ref</th>
          <th data-text="Lot">Lot</th>
          <th data-text="Data Expirarii">Data expirarii</th>
          <th data-text="Data eliberarii">Data eliberarii</th>
          <th data-text="Cantitate cutie">Cantitate cutie</th>
          <th data-text="Cantitate extrasa">Cantitate extrasa</th>
          <th data-text="Persona">Persona</th>
          <th data-text="Data instalarii">Data instalarii</th>
          <th data-text="Data finalizarii">Data finalizarii</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Nr.</th>
          <th>Cod reagent</th>
          <th>Producator</th>
          <th>Denumire reagent</th>
          <th>Ref</th>
          <th>Lot</th>
          <th>Data expirarii</th>
          <th>Data eliberarii</th>
          <th>Cantitate cutie</th>
          <th>Cantitate extrasa</th>
          <th>Persona</th>
          <th>Data instalarii</th>
          <th>Data finalizarii</th>
        </tr>
      </tfoot>

      <tbody>

        @php
          $reports = \App\Report::all();
          $counter = 1;
        @endphp
        @foreach ($reports as $report)
          <tr>
            @php
              $order = \App\Order::find($report->order_id);
            @endphp
              <td>{{ $counter++ }}</td>
              <td>{{ $order->reagentCode($order->reagent_id) }}</td>
              <td>{{ $order->producer($order->reagent_id) }}</td>
              <td>{{ $order->reagentTitle($order->reagent_id) }}</td>
              <td>{{ $order->reagentRef($order->reagent_id) }}</td>
              <td>{{ $order->reagentLot($order->reagent_id) }}</td>
              <td>{{ $order->reagentExpireDate($order->reagent_id) }}</td>
              <td>{{ $order->handed_date }}</td>
              <td>{{  $order->reagentQty($order->reagent_id) }}</td>
              <td>{{ $report->taken_quantity }}</td>
              <td>{{ $report->person($report->person_id) }}</td>
              <td>{{ $report->start_date }}</td>
              <td>{{ $report->end_date }}</td>

        @endforeach

      </tbody>

    </table>

  @else
    <h3 style="text-align:center;">Empty database</h3>
  @endif

  </div>

@endsection
