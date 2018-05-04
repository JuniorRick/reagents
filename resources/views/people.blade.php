@extends('layouts.master')

@section('content')


<div id="page-wrap">

  <div class="container-fluid" style="margin: 5px;">
    <button class="btn" id="form-toggle" name="button">Deschide formular</button>
  </div>


  <div class="container" style="max-width: 600px;">


    <form class="form-container" method="post" action="person/store/"
      style="display: none">

      {{ csrf_field() }}
      <br>
      <p class="h4 text-center mb-4 add-new">Adaugati persoana</p>
      <br>

      <!-- Default input email -->
      <label for="defaultCodIntern" class="grey-text">Nume persoana</label>
      <input type="text" id="defaultFullname" class="form-control" name="fullname">

      <br>

      <div class="text-center mt-4">
          <input class="btn btn-primary" type="submit" id="submit-person" value="Salvare">
          <button class="btn btn-default btn-cancel" type="button">Anulare</button>
      </div>
    </form>
  </div>


  @if (isset($people) && $people->count() != 0)

    <table id="people-table" class="tablesorter records-table">
      <thead>
        <tr>
          <th>Nume persoana</th>
          <th>Actiuni</th>

        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Nume persoana</th>
          <th>Actiuni</th>
        </tr>
      </tfoot>

      <tbody>
        @foreach ($people as $person)

          <tr>

            <td>{{ $person->fullname }}</td>
            <td class="clearfix" style="min-width: 150px;">
              <a class="btn btn-warning btn-xs btn-edit" href="/person/{{ $person->id }}/edit">Edit</a>
              <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
              data-target="#modal-delete{{ $person->id}}" style="margin: 5px 0 0 5px;">Delete</button>
            </td>



            <div id="modal-delete{{ $person->id }}" class="modal fade" role="dialog" style="z-index:9999;">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ $person->fullname }} </h4>
                  </div>
                  <div class="modal-body">
                    <p>Confirmati stergerea persoanei <strong>{{ $person->fullname }}</strong> </p>
                  </div>
                  <div class="modal-footer">
                    <a class="btn btn-danger btn-delete" href="/person/{{ $person->id }}/delete">Sterge</a>
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
