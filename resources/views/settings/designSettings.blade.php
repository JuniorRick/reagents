<div class="box" id="reagent-settings">
  <form class="clearfix" action="/settings/save" method="post">
    {{ csrf_field() }}
    <fieldset style="margin-top: 20px;">
      <legend>Setari reagenti</legend>
      <div class="form-group row">
        <label for="reagent_expire_date_marker" class="col-2 col-form-label">Marcator expirare reagent (zile)</label>
        <div class="col-10">
          <input class="form-control" type="number" value="{{ $settings->reagent_expire_date_marker }}" name="reagent_expire_date_marker">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-6">
        <label for="reagent_expired_color" class="col-2 col-form-label">Culoare reagent expirat</label>
          <input class="form-control" type="color" value="{{ $settings->reagent_expired_color }}" name="reagent_expired_color">
        </div>

        <div class="col-sm-6">
        <label for="reagent_expiring_color" class="col-2 col-form-label">Culoare reagent in curs de expirare</label>
          <input class="form-control" type="color" value="{{ $settings->reagent_expiring_color }}" name="reagent_expiring_color">
        </div>
      </div>

      <div class="form-group row">
        <label for="select_column_sort" class="grey-text">
           Sortare impicita reagenti dupa coloana:</label>
        <select class="form-control selectpicker" id="select_column_sort" name="reagent_sort_by" data-live-search="true">
          @php
           $columns = array(
             '0' => "Producator",
             '1' => 'Data Primirii',
             '2' => 'Cod Intern',
             '3' => 'Denumire',
             '4' => 'Lot',
             '5' => 'Ref',
             '6' => 'Cantitate',
             '7' => 'Data Expirarii',
             '8' => 'Statut',
           );

          @endphp
          @foreach ($columns as $key => $value)
            <option data-tokens="{{ $value }}" value="{{ $key }}">
              {{ $value }}
            </option>
          @endforeach
        </select>
      </div>
    </fieldset>

    <fieldset>
      <legend>Setari Reagent Laborator</legend>
      <div class="form-group row">
        <div class="col-sm-6">
        <label for="reagent_expired_color" class="col-2 col-form-label">Culoare cutie finisata</label>
          <input class="form-control" type="color" value="{{ $settings->empty_state_color }}"
          id="reagent_expired_color" name="empty_state_color">
        </div>

        <div class="col-sm-6">
        <label for="reagent_expiring_color" class="col-2 col-form-label">Culoare cutie utilizata</label>
          <input class="form-control" type="color" value="{{ $settings->used_state_color }}" name="used_state_color">
        </div>
      </div>
    </fieldset>

      <button type="submit" class="btn btn-primary pull-right ">Salvare</button>
  </form>
</div>
