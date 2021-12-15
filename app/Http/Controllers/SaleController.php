<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoletaDetail;
use App\Http\Requests\Sale as RequestsSale;
use App\Models\DetailsSale;
use App\Models\Item;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBoleta(BoletaDetail $request, RequestsSale $rq)
    {
        $code = $request['sale_code'];
        $max_sale = Sale::where("sale_type","=","BOLETA")->where("sale_code","=", $code)->first();
        if($max_sale==null){
            DetailsSale::create($request->validated());
            Sale::create($rq->validated());
            return redirect()->route('dash.boleta')->with('status','Se registro Sale y DetailSale');
        }else{
            DetailsSale::create($request->validated());
            return redirect()->route('dash.boleta')->with('status','Se registro solo DetailSale');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
    public function lookfactura()
    {
        $code_sale = intval(substr((Sale::where("sale_type","=","FACTURA")->max('sale_code')),5))+1;
        return view('sales.factura.index',[
            'code_factura' => $code_sale,
        ]);
    }
    public function pdfboleta(Sale $code){
        $cod = $code['sale_code'] ;
        $detail_sale = DetailsSale::where("sale_code","=",$cod)->latest()->paginate();
        $total_mount = DetailsSale::where("sale_code","=",$cod)->sum('total_mount');
        $pdf = PDF::loadView('sales.boleta.pdf',['details'=>$detail_sale,
        'sumadetail' => $total_mount, 'sale' => $code, 'code' => $cod]);
        return $pdf->stream();
    }
    public function lookboleta()
    {
        $max_sale = Sale::where("sale_type","=","BOLETA")->where("state","=","REGISTRADO")->max('sale_code');
        $detail_sale = DetailsSale::where("sale_code","=",$max_sale)->latest()->paginate();
        $code_sale = intval(substr((Sale::where("sale_type","=","BOLETA")->max('sale_code')),5))+1;
        $total_mount = DetailsSale::where("sale_code","=",$max_sale)->sum('total_mount');
        if($max_sale==null){
            return view('sales.boleta.index',[
            'code_boleta' => $code_sale,
            'items' => Item::latest()->paginate(),
            'details' => $detail_sale,
            'suma_details' => $total_mount,
            'max_sale' => $max_sale,
        ]);
            // return ['code_sale'=>$code_sale];
        }else{
            return view('sales.boleta.index',[
            'code_boleta' => intval(substr($max_sale,5)),
            'items' => Item::latest()->paginate(),
            'details' => $detail_sale,
            'suma_details' => $total_mount,
            'max_sale' => $max_sale,
        ]);
            // return ['detail_sale'=>$max_sale];
        }


    }
}
