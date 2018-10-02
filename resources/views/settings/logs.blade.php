@can('delete')
  <button type="button" class="btn btn-primary" data-toggle="modal"
  data-target="#modal-delete-logs" style="margin: 5px 0 0 5px;">Curatare log-uri</button>
@endcan
</td>

<div id="modal-delete-logs" class="modal fade" role="dialog" style="z-index:9999;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Curatare log-uri</h4>
      </div>
      <div class="modal-body">
        <p>
          <h1 style="color: #f00">Confirmare!</h1>
          <h2>Toate log-urile informative vor fi sterse!
          </h2>
        </p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-danger btn-delete" href="/settings/logs/delete">Sterge</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div class="box" id="reagent-settings">
  @php

  $filename = '../storage/logs/auth.log';
  if(file_exists ( $filename )) {
    $file = fopen($filename, 'r') or die("Erroare de citire log-uri!");
    while(!feof($file)) {
      echo fgets($file) . "<br>";
    }
    fclose($file);
  } else {
    echo "Log-uri absente";
  }
  @endphp

</div>
