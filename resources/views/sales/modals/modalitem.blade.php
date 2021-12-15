<div class="modal fade bd-example-modal-lg" id="modallookitem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width:1000px;">
      <div class="modal-content">
        @include('modals.headmodal',['titlemodal' => 'Seleccionar producto'])
        <div class="modal-body">
          @include('items.table')
        </div>
      </div>
    </div>
  </div>


