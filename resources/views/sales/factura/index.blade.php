@extends('adminlte::page')

@section('title', 'Dashboard')
@section('plugins.Datatables', true)
@section('classes_sidebar','d-none')

@section('content_header')
    <h1 id="h1codef"></h1>
    {{-- <input type="text" name="dni" onfocusout="lookdni(this.value)" maxlength="11"> --}}
    <input type="text" name="dni" id="nameclient" disabled>
    {{-- <form action="/createXML" method="post">
    @csrf
    <button type="submit">Crear XML</button>
    </form> --}}

@stop

@section('content')
    <a data-toggle="modal" data-target="#remodal"><button class="btn btn-outline-info">Crear Item</button></a>
    <table id="tablaitems" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
        <thead class="bg-info text-white">
            <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Categoria</th>
                <th scope="col">Und</th>
                <th scope="col">Existencias</th>
                <th scope="col">Stock Minimo</th>
                <th scope="col">Registrar</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <th scope="col">Codigo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Categoria</th>
                <th scope="col">Und</th>
                <th scope="col">Existencias</th>
                <th scope="col">Stock Minimo</th>
                <th scope="col">Registrar</th>
                <th scope="col">Opciones</th>
            </tr>
        </tbody>
    </table>

@stop

@section('js')
    <script>
    $(document).ready(function() {
        $('#tablaitems').DataTable( {
        "pagingType": "full_numbers"

    } );
    mostrarfactura();

    } );
    function lookdni(dni){

        //alert(dni);
        var dnisize = dni;
        if(dnisize.length==8){
            $.getJSON( '/clients/dni' , {document:dni},
            function (data, textStatus, jqXHR) {
                console.log(data);
                $('#nameclient').val(data.data.fullname);
            },
        );
            //     alert(data.data.dni + data.data.fullname);
            //alert("DNI");

        }else{
            if (dnisize.length==11) {
                lookruc(dnisize);
                //alert("RUC");
            }else{
                alert("Documento inv??lido");
            }
        }
    }

    function lookruc(ruc){
        //alert(dni);
        $.getJSON( '/clients/ruc' , {document:ruc},
            function (data, textStatus, jqXHR) {
               console.log(data);
               alert(data.data.ruc + data.data.name + data.data.address);

            },
        );
    }
    function createXML(tok){
        var token = tok;
        $.post("/createXML", {id:"1", token:token},
            function (data, textStatus, jqXHR) {
                console.log(data);
            },
        );
    }
    function mostrarfactura(){
        var codefactura = String({{ $code_factura }});
        var opc = codefactura.length;
        if(opc<1){
            $("#h1codef").text("F001-00000001");
        }else{
            switch(opc){
            case 1:
            $("#h1codef").text("F001-0000000"+codefactura);
            break;
            case 2:
            $("#h1codef").text("F001-000000"+codefactura);
            break;
            case 3:
            $("#h1codef").text("F001-00000"+codefactura);
            break;
            case 4:
            $("#h1codef").text("F001-0000"+codefactura);
            break;
            case 5:
            $("#h1codef").text("F001-000"+codefactura);
            break;
            case 6:
            $("#h1codef").text("F001-00"+codefactura);
            break;
            case 7:
            $("#h1codef").text("F001-0"+codefactura);
            break;
            case 8:
            $("#h1codef").text("F001-"+codefactura);
            break;
            }
        }
    }
</script>
@stop

