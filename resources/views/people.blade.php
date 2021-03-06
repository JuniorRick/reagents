@extends('layouts.master')

@section('content')


<div id="page-wrap">

  @can('create')
    <div class="container-fluid" style="margin: 5px;">
      <button class="btn" id="form-toggle" name="button">Deschide formular</button>
    </div>
  @endcan

  <div class="container" style="max-width: 600px;">


    <form class="form-container" method="post" action="person/store/"
      style="display: none">

      {{ csrf_field() }}
      <br>
      <p class="h4 text-center mb-4 add-new">Adaugare/Editare persoane</p>
      <br>

      <!-- Default input email -->
      <label for="defaultCodIntern" class="grey-text"><span class="red-star">*</span> Nume persoana</label>
      <input type="text" id="defaultFullname" class="form-control" name="fullname">

      <br>

      <div class="text-center mt-4">
          <input class="btn btn-primary" type="submit" id="submit-person" value="Salvare">
          <button class="btn btn-default btn-cancel" type="button">Anulare</button>
      </div>
    </form>
  </div>


  @if (isset($people) && $people->count() != 0)


    @include('layouts.error')

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
              @can('create')
                <a class="btn btn-warning btn-xs btn-edit" href="/person/{{ $person->id }}/edit">Edit</a>
              @endcan
              @can('delete')
                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
                data-target="#modal-delete{{ $person->id}}" style="margin: 5px 0 0 5px;">Delete</button>
              @endcan
            </td>



            <div id="modal-delete{{ $person->id }}" class="modal fade" role="dialog" style="z-index:9999;">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Eliminare persoana</h4>
                  </div>
                  <div class="modal-body">
                    <p>
                      <h1 style="color: #f00">Atentie!</h1>
                      <h2>La stergerea inregistrarii  <strong>{{ $person->fullname }}</strong>
                        vor fi sterse toate referintele acestei inregistrari
                      </h2>
                    </p>
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
