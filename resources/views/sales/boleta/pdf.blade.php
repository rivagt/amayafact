<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <style>
        *{
            margin: 1px;
            padding: 0px;
        }
        div#container{
            margin: auto;
            margin-top: 20px;
            margin-right: 20px;
            margin-left: 20px;
            width: auto;
            height: auto;
        }
        div#logo{
            width: 130px;
            height: 130px;
            float: left;

        }
        div#empresa{
            float: right;
            width: 350px;
            height: 107px;
            padding-top: 23px;
            text-align: center;
        }
        div#cardruc{
            float: right;
            width: 250px;
            height: 107px;
            padding-top: 23px;
            text-align: center;
            border-radius: 4%;
            border-style: ridge;
            border-color: rgb(28, 143, 179);
        }
        div#cardruccenter{
            background-color: rgb(28, 143, 179);
            margin: 0;
        }
        div#dataclient{
            margin-top: 140px;
            border-style: ridge;
            border-color: rgb(28, 143, 179);
            border-radius: 2%;
            padding: 10px;
            padding-right: 80px;
            height: 140px;
        }
        div#dataclientleft{
            float: left;
        }
        div#dataclientright{
            margin-left: 250px;
            float: right;
        }
        thead#headid{
            background-color: rgb(28, 143, 179);
            color: white;
        }
        table#tablasaledetail {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        tr:nth-child(even){background-color: #f2f2f2;}
        tr:hover {background-color: #ddd;}
        div#tablehead{
            border-style: ridge;
            border-color: rgb(28, 143, 179);
            border-radius: 1%;
            padding: 5px;
            height: 300px;
            margin-top: 5px;
        }
        div#subtotal{
            height: 180px;
            margin-top: 5px;
            padding: 10px;
            border-style: ridge;
            border-color: rgb(28, 143, 179);
            border-radius: 2%;
        }
        div#montletras{
            float: left;
            height: 180px;
        }
        div#leyendasm{
            float: right;
            height: 180px;
            width: 150px;
        }
        div#montos{
            float: right;
            height: 180px;
            width: 100px;
        }
        th.itemsnum{
            text-align: right;
        }
        th.items{
            text-align: center;
        }
        th.des{
            text-align: left;
        }
        div#cuentas{
            margin-top: 5px;
            height: 50px;
            padding: 10px;
            border-style: ridge;
            border-color: rgb(28, 143, 179);
            border-radius: 2%;
        }
        div#cuentaid{
            float: left;
        }
        div#nrocuenta{
            float: right;
        }
        div#cci{
            float: right;
            margin-left: 40px;
        }
        div#foot{
            margin-top: 5px;

        }
        div#qr{
            float: left;
            width: 120px;
            height: 120px;
            padding: 10px;
            border-style: ridge;
            border-color: rgb(28, 143, 179);
            border-radius: 2%;
        }
        div#footright{
            float: right;
            padding: 10px;
            width: 572px;
            height: 120px;
            border-style: ridge;
            border-color: rgb(28, 143, 179);
            border-radius: 1%;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="container">
        <div id="logo">
            <img src="vendor/adminlte/dist/img/AmayaLogo.png" alt="logo" style="width: 130px">
        </div>
        <div id="cardruc">
            <div id="cardructop">
                <p>RUC: 20604665567</p>
            </div>
            <div id="cardruccenter">
                <h4>BOLETA DE VENTA ELECTRONICA</h4>
            </div>
            <div id="cardrucbottom">
                <p>{{ $code }}</p>
            </div>
        </div>
        <div id="empresa">
            <h3 style="color: rgb(28, 143, 179);"><strong>J & L AMAYA CORPORATION S.A.C.</strong></h3>
            <p>AV. MARGINAL S/N URB. SANTA ANA</p>
            <p>PERENE - CHANCHAMAYO - JUNIN</p>
            <p>Telefono: 945578698</p>
        </div>
        <div id="dataclient">
            <div id="dataclientleft">
                <p>Fecha de Vencimiento</p>
                <p>Fecha de Emisión</p>
                <p>Cliente</p>
                <p>DNI</p>
                <p>Tipo de moneda</p>
                <p>Observación</p>
            </div>
            <div id="dataclientright">
                <p>:</p>
                <p>: {{ $sale->emited_time }}</p>
                <p>: {{ $sale->fullname_client }}</p>
                <p>: {{ $sale->document_client }}</p>
                <p>: SOLES</p>
                <p>: BIENES TRANSFERIDOS EN LA AMAZONIA PARA SER CONSUMIDOS EN LA MISMA</p>
            </div>
        </div>
        <div id="tablehead">
            <table id="tablasaledetail" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
                <thead class="bg-info text-white" id="headid">
                    <tr>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Unidad Medida</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">P. Unitario</th
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody id="bodydet">
                    @forelse ($details as $i)
                    <tr class="tritems">
                        <th class="items">{{ number_format(($i->quantity),2,'.','') }}</th>
                        <th class="items">{{ $i->measure }}</th>
                        <th class="des">{{ $i->description }}</th>
                        <th class="itemsnum">{{ number_format(($i->unity_price),2,'.','') }}</th>
                        <th class="itemsnum">{{ number_format(($i->total_mount),2,'.','') }}</th>>
                        </th>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
        <div id="subtotal">
            <div id="montletras">
                <p>SON: AQUI VA MONTO EN LETRAS</p>
            </div>
            @if (number_format(($sale->impost_mount),2,'.','')=='0.00')
            <div id="montos">
                <p>S/. 0.00</p>
                <p>S/. {{ number_format(($sale->total_mount),2,'.','') }}</p>
                <p>S/. 0.00</p>
                <p>S/. 0.00</p>
                <p>S/. 0.00</p>
                <p>S/. 0.00</p>
                <p>S/. 0.00</p>
                <p>S/. 0.00</p>
                <p>S/. {{ number_format(($sale->total_mount),2,'.','') }}</p>
            </div>
            <div id="leyendasm">
                <p>Op. Gravada</p>
                <p>Op. Exonerada</p>
                <p>Op. Inafecta</p>
                <p>ISC</p>
                <p>IGV</p>
                <p>ICBPER</p>
                <p>Otros Cargos</p>
                <p>Otros Tributos</p>
                <p>Importe Total</p>
            </div>
            @else
            <div id="montos">
                <p>S/. {{ number_format(($sale->subtotal_mount),2,'.','') }}</p>
                <p>S/. 0.00</p>
                <p>S/. 0.00</p>
                <p>S/. 0.00</p>
                <p>S/. {{ number_format(($sale->impost_mount),2,'.','') }}</p>
                <p>S/. 0.00</p>
                <p>S/. 0.00</p>
                <p>S/. 0.00</p>
                <p>S/. {{ number_format(($sale->total_mount),2,'.','') }}</p>
            </div>
            <div id="leyendasm">
                <p><strong>Op. Gravada</strong></p>
                <p><strong>Op. Exonerada</strong></p>
                <p><strong>Op. Inafecta</strong></p>
                <p><strong>ISC</strong></p>
                <p><strong>IGV</strong></p>
                <p><strong>ICBPER</strong></p>
                <p><strong>Otros Cargos</strong></p>
                <p><strong>Otros Tributos</strong></p>
                <p><strong>Importe Total</strong></p>
            </div>
            @endif
        </div>
        <div id="cuentas">
            <div id="cuentaid">
                <p><strong>CUENTA</strong></p>
                <p>BANCO DEL CREDITO DEL PERU - SOLES</p>
            </div>
            <div id="cci">
                <p><strong>CCI</strong></p>
                <p>00241000896330504696</p>
            </div>
            <div id="nrocuenta">
                <p><strong>NRO CUENTA</strong></p>
                <p>410-8963305-0-46</p>
            </div>
        </div>
        <div id="foot">
            <div id="qr">
                @if (file_exists('../public/qrcodes/QR_'.$code.'.png'))
                <img src="{{ '../public/qrcodes/QR_'.$code.'.png' }}" alt="qrcode">
                @else
                {!! QrCode::format('png')->size(120)->encoding('UTF-8')->generate('20604665567|03|BOO1|'.substr($code,5).'|'.number_format(($sale->impost_mount),2,'.','').'|'.number_format(($sale->total_mount),2,'.','').'|'.$sale->emited_time.'|1|+pruib33lOapq6GSw58GgQLR8VGIGqANloj4EqB1cb4=', '../public/qrcodes/QR_'.$code.'.png'); !!}
                <img src="{{ '../public/qrcodes/QR_'.$code.'.png' }}" alt="qrcode">
                @endif
            </div>
            <div id="footright">
                <p>Representación impresa de la Boleta de Venta Electronica.</p>
                <p>Consulte su documento en <a href="amaya.service">https://laraveles.com/directivas-bladeif/</a></p>
            </div>
        </div>
    </div>


</body>
</html>
