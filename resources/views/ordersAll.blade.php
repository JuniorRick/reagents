@extends('layouts.master')

@section('content')


<div id="page-wrap">

  {{-- <div class="container-fluid" style="margin: 5px;">
    <button class="btn" id="form-toggle" name="button">Deschide formular</button>
  </div> --}}


  <div class="container">



  @php
    $counter = 0;
  @endphp
  @if (isset($orders) && $orders->count() != 0)

    <h3 class="text-center">
      Total reagenti eliberati
    </h3>
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
          <th data-text="Persona">Persona</th>
          <th data-text="Data eliberarii">Data eliberarii</th>
          <th data-text="Cantitate cutie">Cantitate cutie</th>
          <th data-text="Cantitate activa">Cantitate activa</th>
          <th data-text="Statut">Statut</th>
          <th data-text="Actiuni">Actiuni</th>
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
          <th>Persona</th>
          <th>Data eliberarii</th>
          <th>Cantitate cutie</th>
          <th>Cantitate activa</th>
          <th>Statut</th>
          <th>Actiuni</th>
        </tr>
      </tfoot>

      <tbody>

        @foreach ($orders as $order)
          <tr style="background: {{ $order->state == 1 ? '#ed9999' : '#c2c1c1' }}">
            <td>{{ ++$counter }}</td>
            <td> {{ $order->reagentCode($order->reagent_id) }} </td>
            <td> {{ $order->producer($order->reagent_id) }} </td>
            <td> {{ $order->reagentTitle($order->reagent_id) }} </td>
            <td> {{ $order->reagentRef($order->reagent_id) }} </td>
            <td> {{ $order->reagentLot($order->reagent_id) }} </td>
            <td> {{ explode(" ", $order->reagentExpireDate($order->reagent_id))[0] }} </td>
            <td> {{ $order->person($order->person_id) }} </td>
            <td> {{ $order->handed_date }} </td>
            <td> {{ $order->reagentQty($order->reagent_id) }} </td>
            <td> {{ $order->order_quantity }} </td>
            <td> {{ $order->state == 0 ? 'Activ ' : 'Finisat ' }} </td>
            <td class="clearfix" style="min-width: 120px;">


            <span class="btn-group">

              <a href="/reports/{{ $order->id }}" class="btn btn-primary btn-xs" style="margin-left: 5px;"">Detalii</a>

              @can('delete')
                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
                data-target="#modal-delete{{ $order->id}}" style="margin-left: 5px;">Sterge</button>
              @endcan
            </span>

              <div id="modal-delete{{ $order->id }}" class="modal fade" role="dialog" style="z-index:9999;">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"> Anulare eliberare</h4>
                    </div>
                    <div class="modal-body">
                      <h4>Confirmati stergerea eliberarii
                        <strong>
                          {{ $order->reagentCode($order->reagent_id) }}
                        </strong>
                      </h4>
                    </div>
                    <div class="modal-footer">
                      <a class="btn btn-danger btn-delete" href="/order/{{ $order->id }}/delete">Sterge</a>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>

              <div id="modal-details{{ $order->id }}" class="modal fade" role="dialog" style="z-index:9999;">
                <div class="modal-dialog">

            </td>
        @endforeach

      </tbody>

    </table>

  @else
    <h3 style="text-align:center;">Empty database</h3>
  @endif

  </div>

@endsection
