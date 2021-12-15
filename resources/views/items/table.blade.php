<table id="tablaitems" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
    <thead class="bg-info text-white">
        <tr>
            <th scope="col">Codigo</th>
            <th scope="col">Categoria</th>
            <th scope="col">Marca</th>
            <th scope="col">Descripción</th>
            <th scope="col">Und</th>
            <th scope="col">Existencias</th>
            <th scope="col">Precio</th>
            <th scope="col">Agregar</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($items as $i)
        <tr>
            <th>{{ $i->code }}</th>
            <th>{{ $i->category }}</th>
            <th>{{ $i->brand }}</th>
            <th>{{ $i->description }}</th>
            <th>{{ $i->measure }}</th>
            <th>{{ number_format(($i->stock),2,'.','') }}</th>
            <th>{{ number_format(($i->saleprice),2,'.','') }}</th>
            <th><a data-toggle="modal" data-target="#modalnewsale" onclick="mostrardatos('{{ $i->code }}','{{ $i->description }}','{{ number_format(($i->saleprice),2,'.','') }}')"><i class="fas fa-plus"></i></button></a></th>
            {{-- <th><a onclick="cargardatos({{ $i->code }})"><i class="fas fa-plus"></i></button></a></th> --}}
        </tr>
        @include('sales.modals.modalnewsale')
        @empty

        @endforelse
    </tbody>
</table>
<script>
    function mostrardatos(code,des,price) {
        // alert(code+des+price);
        $("#preciounitid").val(price);
        $("#iddescripcion").val(des);
        $("#subtotalid").val(price);
        $("#totalsaleid").val(price);
        $("#idcantidad").val('1.00');
     }
</script>
