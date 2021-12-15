<div class="modal fade bd-example-modal-lg" id="modalnewsale" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width:1000px;">
      <div class="modal-content">
        @include('modals.headmodal',['titlemodal' => 'Registrar nueva venta'])
        <div class="modal-body">
            <form method="post" action="{{ route('boleta.store') }}">
                <input type="text" value="74326379" name="document_client" hidden>
                <input type="text" value="RIVALDO JOSE CLEMENTE GARCIA TAIPE" name="fullname_client" hidden>
                <input type="text" value="BOLETA" name="sale_type" hidden>
                <input type="text" value="RG19" name="user_code" hidden>
                <input type="text" value="REGISTRADO" name="state" hidden>
                <input type="text" value="2021-12-09" name="emited_time" hidden>
                @include('sales.boleta._formcreate')
            </form>
        </div>
      </div>
    </div>
  </div>
