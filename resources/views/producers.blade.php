@extends('layouts.master')

@section('content')


<div id="page-wrap">
  @can('create')
    <div class="container-fluid" style="margin: 5px;">
      <button class="btn" id="form-toggle" name="button">Deschide formular</button>
    </div>
  @endcan

  <div class="container" style="max-width: 600px;">


    <form class="form-container" method="post" action="producer/store/"
      style="display: none">

      {{ csrf_field() }}
      <br>
      <p class="h4 text-center mb-4 add-new">Adaugati producator</p>
      <br>

      <!-- Default input email -->
      <label for="defaultCodIntern" class="grey-text">Nume producator</label>
      <input type="text" id="defaultName" class="form-control" name="name">

      <br>

      <div class="text-center mt-4">
          <input class="btn btn-primary" type="submit" id="submit-producer" value="Salvare">
          <button class="btn btn-default btn-cancel" type="button">Anulare</button>
      </div>
    </form>
  </div>


  @if (isset($producers) && $producers->count() != 0)

    <table id="producers-table" class="tablesorter records-table">
      <thead>
        <tr>
          <th>Nume producator</th>
          <th>Actiuni</th>

        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Nume producator</th>
          <th>Actiuni</th>
        </tr>
      </tfoot>

      <tbody>
        @foreach ($producers as $producer)

          <tr>

            <td>{{ $producer->name }}</td>
            <td class="clearfix" style="min-width: 150px;">
              @can('create')
                <a class="btn btn-warning btn-xs btn-edit" href="/producer/{{ $producer->id }}/edit">Edit</a>
              @endcan
              @can('delete')
                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
                data-target="#modal-delete{{ $producer->id}}" style="margin: 5px 0 0 5px;">Delete</button>
              @endcan
            </td>



            <div id="modal-delete{{ $producer->id }}" class="modal fade" role="dialog" style="z-index:9999;">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ $producer->name }} </h4>
                  </div>
                  <div class="modal-body">
                    <p>Confirmati stergerea producatorui <strong>{{ $producer->name }}</strong> </p>
                  </div>
                  <div class="modal-footer">
                    <a class="btn btn-danger btn-delete" href="/producer/{{ $producer->id }}/delete">Sterge</a>
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
