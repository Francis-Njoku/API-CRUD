<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExternalBookResource;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function index()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/todos/');
       // $response = $client->request('GET', 'https://www.anapioficeandfire.com/api/books');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        $getArray = json_decode($body);

        if (count($getArray) >= 1)
        {
            return $getArray;
        }
        else{
            return array(
            "status_code"=> 200,
                "status" => "success",
                "data" => []
            );
        }





    }



}
