@extends('layouts.master')

@section('content')


<div id="page-wrap">

  {{-- <div class="container-fluid" style="margin: 5px;">
    <button class="btn" id="form-toggle" name="button">Deschide formular</button>
  </div> --}}


  <div class="container" style="max-width: 600px;">



  @if (isset($orders) && $orders->count() != 0)

    <table id="orders-table" class="tablesorter records-table">
      <thead>
        <tr>
          <th>Cod reagent</th>
          <th>Denumire reagent</th>
          <th>Persona</th>
          <th>Data eliberarii</th>
          <th>Actiuni</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
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

        @endforeach

      </tbody>

    </table>
  @else
    <h3 style="text-align:center;">Empty database</h3>
  @endif

  </div>

@endsection
