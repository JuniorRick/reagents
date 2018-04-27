@extends('layouts.master')

@section('content')


<div id="page-wrap">

  {{-- <div class="container-fluid" style="margin: 5px;">
    <button class="btn" id="form-toggle" name="button">Deschide formular</button>
  </div> --}}


  <div class="container" style="max-width: 600px;">



  @php
    $counter = 0;
  @endphp
  @if (isset($orders) && $orders->count() != 0)

    {{-- <div class="table-hint">
      Apasati pe antetul colonitei pentru sortearea dupa coloana
    </div> --}}
    <table id="orders-table" class="tablesorter records-table">
      <thead>
        <tr >
          <th data-text="Nr.">Nr.</th>
          <th data-text="Cod reagent">Cod reagent</th>
          <th data-text="Denumire reagent">Denumire reagent</th>
          <th data-text="Persona">Persona</th>
          <th data-text="Data eliberarii">Data eliberarii</th>
          <th data-text="Actiuni">Actiuni</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Nr.</th>
          <th>Cod reagent</th>
          <th>Denumire reagent</th>
          <th>Persona</th>
          <th>Data eliberarii</th>
          <th>Actiuni</th>
        </tr>
      </tfoot>

      <tbody>

        @foreach ($orders as $order)
          <tr>
            <td>{{ ++$counter }}</td>
            <td> {{ $order->reagentCode($order->reagent_id) }} </td>
            <td> {{ $order->reagentTitle($order->reagent_id) }} </td>
            <td> {{ $order->person($order->person_id) }} </td>
            <td> {{ $order->created_at }} </td>
            <td class="clearfix" style="min-width: 50px;">
              {{-- <a class="btn btn-warning btn-xs btn-edit" href="/order/{{ $order->id }}/edit">Edit</a> --}}
              <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
              data-target="#modal-delete{{ $order->id}}" style="margin-left: 5px;">Sterge</button>

              <div id="modal-delete{{ $order->id }}" class="modal fade" role="dialog" style="z-index:9999;">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"> {{ $order->reagentTitle($order->reagent_id) }}</h4>
                    </div>
                    <div class="modal-body">
                      <p>Confirmati stergerea reagentului
                        <strong>
                          {{ $order->reagentCode($order->reagent_id) }}
                        </strong>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <a class="btn btn-danger btn-delete" href="/order/{{ $order->id }}/delete">Sterge</a>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>

            </td>
        @endforeach

      </tbody>

    </table>

  @else
    <h3 style="text-align:center;">Empty database</h3>
  @endif

  </div>

@endsection
