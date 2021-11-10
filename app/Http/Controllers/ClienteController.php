<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lookdni()
    {
        $document = $_GET['document'];
        $apiKey = 'YDm97Jm9RYT6czPbgUegBIEAH244AeKSaCp5Fe7F9C3wMn4rpx0xWywrSqnr';
        $url = 'https://api.peruapis.com/v1/dni';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('document' => $document),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$apiKey,
                'Accept: application/json'
            ),
          ));

        $response = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($response);

        return $json;
    }
    public function lookruc()
    {
        $document = $_GET['document'];
        $apiKey = 'YDm97Jm9RYT6czPbgUegBIEAH244AeKSaCp5Fe7F9C3wMn4rpx0xWywrSqnr';
        $url = 'https://api.peruapis.com/v1/ruc';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('document' => $document),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$apiKey,
                'Accept: application/json'
            ),
          ));

        $response = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($response);

        return $json;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
