@extends('layouts.master')


@section('content')


<div id="page-wrap">

@if(auth()->user()->can('create reagents') || Auth::user()->hasRole('admin'))
  <div class="container-fluid" style="margin: 5px;">
    <button class="btn" id="form-toggle" name="button">Deschide formular</button>
  </div>
@endif

  <div class="container" style="max-width: 600px;">

    <div class="box-error"></div>

    <form class="form-container" id="form-reagents" method="post" action="reagent/store/"
      style="display: none">

      {{ csrf_field() }}
      <br>
      <div class="clearfix">
        <p class="h4 text-center mb-4 add-new">Adaugare/Editare reagenti</p>
      </div>
      <br>


      <div class="row">
        <div class="form-group">
          <div class='col-sm-6'>
            <label for="select_producer" class="grey-text"><span class="red-star">*</span>
               <span id="producer_text">Producator</span></label>
            <select class="form-control selectpicker" id="select_producer" name="producer_id" data-live-search="true">
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

          <div class='col-sm-6'>
            <label for="datetimepicker1" class="grey-text"><span class="red-star">*</span>
               <span id="receiveDate_text">Data factura</span></label>
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
      <label for="defaultCodIntern" class="grey-text"><span class="red-star">*</span>
        <span id="code_text">Cod Intern</span></label>
      <input type="text" id="defaultCodIntern" class="form-control" name="code">

      {{-- <br> --}}

      <!-- Default input password -->
      <label for="defaultDenumire" class="grey-text"><span class="red-star">*</span>
        <span id="name_text">Denumire</span></label>
      <input type="text" id="defaultDenumire" class="form-control" name="name">

      {{-- <br> --}}

      <!-- Default input password -->
      <label for="defaultCodLot" class="grey-text">Lot</label>
      <input type="text" id="defaultCodLot" class="form-control" name="lot">

      <label for="defaultCodRef" class="grey-text">Ref</label>
      <input type="text" id="defaultCodRef" class="form-control" name="ref">

      <label for="defaultQty" class="grey-text"><span class="red-star">*</span>
        <span id="qty_text">Cantitate (Teste / ml)</span></label>
      <input type="text" id="defaultQty" class="form-control" name="quantity">


      <label for="defaultExpire" class="grey-text"><span class="red-star">*</span>
        <span id="expireDate_text">Data Expirarii</span></label>
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


  @if (isset($reagents) && $reagents->count() > 0)

    <h3 class="text-center">
      Reagenti inregistrati
    </h3>

    @include('layouts.error')

    <table id="reagents-table" class="tablesorter records-table">
      <thead>
        <tr>
          <th>Producator</th>
          <th>Data primirii</th>
          <th>Cod intern</th>
          <th>Denumire</th>
          <th>Lot</th>
          <th>Ref</th>
          <th>Cantitate</th>
          <th>Data expirarii</th>
          <th>Statut</th>
          <th>Actiuni</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Producator</th>
          <th>Data primirii</th>
          <th>Cod intern</th>
          <th>Denumire</th>
          <th>Lot</th>
          <th>Ref</th>
          <th>Cantitate</th>
          <th>Data expirarii</th>
          <th>Statut</th>
          <th>Actiuni</th>
        </tr>
      </tfoot>

      <tbody>
        @foreach ($reagents as $reagent)

          <?php
            $today = Carbon\Carbon::today();
            $expire = new Carbon\Carbon($reagent->expire);
            $settings = \App\Setting::first();
          ?>
          <tr style="background:
          {{ $expire < $today ? $settings->reagent_expired_color : ($expire->diffInDays($today) < 30 ? $settings->reagent_expiring_color : '#fff')}}">
            <td>{{ $reagent->producer() }}</td>
            <td>{{ explode(" ", $reagent->receive_date)[0]}}</td>
            <td>{{ $reagent->code }}</td>
            <td>{{ $reagent->name }}</td>
            <td>@if($reagent->lot == '') - @else {{ $reagent->lot}} @endif</td>
            <td>@if($reagent->ref == '') - @else {{ $reagent->ref}} @endif</td>
            <td>@if($reagent->quantity == '') - @else {{ $reagent->quantity}} @endif</td>
            <td>{{ explode(" ", $reagent->expire)[0]}}</td>
            <td>{{ $reagent->is_handed ? 'Eliberat' :  'In stoc' }}</td>
            <td class="clearfix" style="min-width: 160px;">
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
                    <h4 class="modal-title">Stergere ireversibila a inregistrarii</h4>
                  </div>
                  <div class="modal-body">
                    <p>
                      <h1 style="color: #f00">Atentie!</h1>
                      <h2>La stergerea inregistrarii
                        <strong> {{ $reagent->code }}</strong>
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

  <script type="text/javascript">
    var sort_by = {{ \App\Setting::first()->reagent_sort_by }}
  </script>
@endsection
