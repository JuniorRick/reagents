{{-- <div class="settings-grid">
  <div class="grid-item" id="roles-settings">
    <fieldset>
      <legend>Setari roluri</legend>
      <form class="" action="/role/add" method="post">

        <label for="roles" class="grey-text">Adauga rol</label>
        <div class="input-group">
            <input type="text" id="roles" class="form-control" name="roles">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-primary pull-right ">Adaugare rol</button>
        </div>
        </div>
      </form>

      @if (isset($roles) && $roles->count() > 0)

        @include('layouts.error')

        <table id="permission-table" class="tablesorter records-table">
          <thead>
            <tr>
              <th>Rol</th>
              <th>Actiuni</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Rol</th>
              <th>Actiuni</th>
            </tr>
          </tfoot>

          <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $permission->name}}</td>

                <td class="clearfix" style="min-width: 100px;">
                  @can('create')
                    <a class="btn btn-warning btn-xs btn-edit" href="/role/{{ $role->id }}/edit">Edit</a>
                  @endcan
                  @can('delete')
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
                    data-target="#modal-delete{{ $role->id}}" style="margin: 5px 0 0 5px;">Delete</button>
                  @endcan
                </td>


                <div id="modal-delete{{ $role->id }}" class="modal fade" role="dialog" style="z-index:9999;">
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
                            <strong> {{ $role->name }}</strong>
                            vor fi sterse toate referintele acestei inregisrari
                          </h2>
                        </p>
                      </div>
                      <div class="modal-footer">
                        <a class="btn btn-danger btn-delete" href="/role/{{ $role->id }}/delete">Sterge</a>
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

    </fieldset>
  </div>
  <div class="grid-item">

<fieldset>
  <legend>Setari permisiuni</legend>
  <form class="" action="index.html" method="post">
    <label for="permissions" class="grey-text">Adauga permisiune</label>
    <div class="input-group">
        <input type="text" id="permissions" class="form-control" name="permissions">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-primary pull-right ">Adaugare permisiune</button>
        </div>
    </div>
  </form>
</fieldset>

    @if (isset($permissions) && $permissions->count() > 0)

      @include('layouts.error')

      <table id="permission-table" class="tablesorter records-table">
        <thead>
          <tr>
            <th>Permisiune</th>
            <th>Actiuni</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Permisiune</th>
            <th>Actiuni</th>
          </tr>
        </tfoot>

        <tbody>
          @foreach($permissions as $permission)
          <tr>
              <td>{{ $permission->name}}</td>

              <td class="clearfix" style="min-width: 100px;">
                @can('create')
                  <a class="btn btn-warning btn-xs btn-edit" href="/permission/{{ $permission->id }}/edit">Edit</a>
                @endcan
                @can('delete')
                  <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
                  data-target="#modal-delete{{ $permission->id}}" style="margin: 5px 0 0 5px;">Delete</button>
                @endcan
              </td>


              <div id="modal-delete{{ $permission->id }}" class="modal fade" role="dialog" style="z-index:9999;">
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
                          <strong> {{ $permission->name }}</strong>
                          vor fi sterse toate referintele acestei inregisrari
                        </h2>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <a class="btn btn-danger btn-delete" href="/permission/{{ $permission->id }}/delete">Sterge</a>
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
</div> --}}

<div class="" style="text-align: center; font-size:50px;">
  In curs de dezvoltare
</div>
