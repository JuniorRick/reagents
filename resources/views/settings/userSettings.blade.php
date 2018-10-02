<div class="settings-grid">
  <div class="grid-item" id="users-settings">
      <fieldset>
        <legend>Setari utilizatori</legend>
          <div class="title">Adauga utilizator</div>
        <div class="card-body">
            <form method="POST"  class="form-container" id="form-users" action="/user/store">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group row">
                  <label for="select_role" class="col-md-4 col-form-label text-md-right grey-text">
                    <span id="role_text">Rol</span></label>
                  <div class='col-md-6'>

                    <select class="form-control selectpicker" id="select_role" name="role_id" data-live-search="true">
                      <option value="default" selected disabled>----- Selectati rolul -----</option>
                      @php
                       $roles = \Spatie\Permission\Models\Role::all();
                      @endphp

                      @foreach ($roles as $role)
                        <option data-tokens="{{ $role->name }}" value="{{ $role->id }}">
                          {{ $role->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <script type="text/javascript">
                </script>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                      <input class="btn btn-primary" type="submit" id="submit-user" value="Salvare">
                    </div>
                </div>
            </form>
        </div>

      </fieldset>
  </div>

<div class="grid-item">

  @if (isset($users) && $users->count() > 0)

    @include('layouts.error')

    <table id="users-table" class="tablesorter records-table">
      <thead>
        <tr>
          <th>Nume</th>
          <th>Email</th>
          <th>Rol</th>
          <th>Actiuni</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Nume</th>
          <th>Email</th>
          <th>Rol</th>
          <th>Actiuni</th>
        </tr>
      </tfoot>

      <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name}}</td>
            <td>{{ $user->email}}</td>
            <td>{{ sizeof($user->roles->pluck('name')) > 0  ? $user->roles->pluck('name')[0] : ""}}</td>
            <td class="clearfix" style="min-width: 100px;">
              @can('create')
                <a class="btn btn-warning btn-xs btn-edit" href="/user/{{ $user->id }}/edit">Edit</a>
              @endcan
              @can('delete')
                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
                data-target="#modal-delete{{ $user->id}}" style="margin: 5px 0 0 5px;">Delete</button>
              @endcan
            </td>


            <div id="modal-delete{{ $user->id }}" class="modal fade" role="dialog" style="z-index:9999;">
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
                        <strong> {{ $user->name }}</strong>
                        vor fi sterse toate referintele acestei inregisrari
                      </h2>
                    </p>
                  </div>
                  <div class="modal-footer">
                    <a class="btn btn-danger btn-delete" href="/user/{{ $user->id }}/delete">Sterge</a>
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
