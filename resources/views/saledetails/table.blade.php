<table id="tablasaledetail" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
    <thead class="bg-info text-white">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Und</th>
            <th scope="col">Producto</th>
            <th scope="col">P.Unit</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Imp.</th>
            <th scope="col">Total</th>
            <th scope="col">Opc.</th>
        </tr>
    </thead>
    <tbody>
        <div hidden>{{ $int = 0; }}</div>
        @forelse ($details as $i)
        <div hidden>{{ $int++; }}</div>
        <tr>
            <th>{{ $int }}</th>
            <th>{{ $i->quantity }}</th>
            <th>{{ $i->measure }}</th>
            <th>{{ $i->description }}</th>
            <th>{{ number_format(($i->unity_price),2,'.','') }}</th>
            <th>{{ number_format(($i->subtotal_mount),2,'.','') }}</th>
            <th>{{ number_format(($i->impost_mount),2,'.','') }}</th>
            <th>{{ number_format(($i->total_mount),2,'.','') }}</th>
            <th>
                <a style="font-size: 1em; color: #FFB000;" data-toggle="modal" data-target="#entradamodal{{$i->sale_code}}">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <a style="font-size: 1em; color: #ff0000;" data-toggle="modal" data-target="#entradamodal{{$i->sale_code}}">
                    <i class="fas fa-eraser"></i>
                </a>
            </th>
        </tr>
        @empty

        @endforelse
    </tbody>
    <tfoot>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><h6><strong>Total</strong></h6></td>
        <td id="tdtotal"> <strong>{{ number_format(($sumadetail),2,'.','') }}</strong></td>
        <td><a href="#" style="font-size: 2em; color: #204395"
            onclick="registrarboleta()"><i class="far fa-thumbs-up"></i></a></td>
    </tfoot>
</table>
