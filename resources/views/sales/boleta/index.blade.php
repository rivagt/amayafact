@extends('adminlte::page')

@section('title', 'Dashboard')
@section('plugins.Datatables', true)
@section('classes_sidebar','d-none')

@section('content_header')
    {{-- <select name="tipocliente" id="tipoclienteid"></select> --}}
    <input type="text" name="dni" onfocusout="lookdni(this.value)" maxlength="11">

    <a href="{{ route('dash.pdfboleta', strval($max_sale)) }}"><button>PDF</button></a>
    <form   action="/createXML" method="post">
    @csrf
    <button type="submit">Crear XML</button>

    <div class="row">
        <div class="col-2">
            <h1>Boleta N° </h1>
        </div>
        <div class="col-3">
            <h1 id="h1code"></h1>
            <input name="serie_boleta" id="h1codeinput" hidden>
        </div>
        <div class="col-5"></div>
        <div class="col-2">
            <input type="date" name="date_emited" id="dateemitido">
        </div>
    </div>
    <br>
    <input type="text" name="dni" id="nameclient" disabled>
    </form>
    <br>
    <label>Agregar Item: <a class="btn btn-success" style="font-size: 1em;" onclick="validacion()"><i class="fas fa-plus"></i></a></label>
@stop

@section('content')
    {{-- <a data-toggle="modal" data-target="#remodal"><button class="btn btn-outline-info">Crear Item</button></a> --}}
    @include('saledetails.table' ,['sumadetail' => $suma_details])
    @include('sales.modals.modalitem')


@stop

@section('js')
    <script>
    $(document).ready(function() {
        $('#tablaitems').DataTable( {
            "pagingType": "full_numbers"
        });
        // $('#tablasaledetail').DataTable( {
        //     "pagingType": "full_numbers"
        // });

    mostrarboleta();
    // alert('msg');
    // alert({{ $max_sale }});
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
                alert("Documento inválido");
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
    function validaNumericos(event) {
	    if (event.charCode >= 48 && event.charCode <= 57) {
		    return true;
	    }
	    return false;
    }
    function validaNumdouble(event) {
	    if (event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46) {
	    	return true;
	    }
	    return false;
    }
    function mostrarboleta(){
        var codeboleta = String({{ $code_boleta }});
        var opc = codeboleta.length;

        if(opc>8){
            $("#h1code").text(codeboleta);
            $("#h1codeinput").val(codeboleta);
        }else{
            switch(opc){
            case 1:
            $("#h1code").text("B001-0000000"+codeboleta);
            $("#h1codeinput").val("B001-0000000"+codeboleta);
            break;
            case 2:
            $("#h1code").text("B001-000000"+codeboleta);
            $("#h1codeinput").val("B001-000000"+codeboleta);
            break;
            case 3:
            $("#h1code").text("B001-00000"+codeboleta);
            $("#h1codeinput").val("B001-00000"+codeboleta);
            break;
            case 4:
            $("#h1code").text("B001-0000"+codeboleta);
            $("#h1codeinput").val("B001-0000"+codeboleta);
            break;
            case 5:
            $("#h1code").text("B001-000"+codeboleta);
            $("#h1codeinput").val("B001-000"+codeboleta);
            break;
            case 6:
            $("#h1code").text("B001-00"+codeboleta);
            $("#h1codeinput").val("B001-00"+codeboleta);
            break;
            case 7:
            $("#h1code").text("B001-0"+codeboleta);
            $("#h1codeinput").val("B001-0"+codeboleta);
            break;
            case 8:
            $("#h1code").text("B001-"+codeboleta);
            $("#h1codeinput").val("B001-"+codeboleta);
            break;
            }
        }
    }
    function validacion() {
        var dateemi = $("#dateemitido").val();
        if (dateemi==""||dateemi==null||dateemi==undefined) {
            alert("Ingrese fecha");
        }else{
            $("#modallookitem").modal("show");
            // data-toggle="modal" data-target="#modallookitem"
        }
     }
</script>
@stop

