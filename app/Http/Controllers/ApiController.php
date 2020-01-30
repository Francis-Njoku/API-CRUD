<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExternalBookResource;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request as Re;

class ApiController extends Controller
{


    /**
     * @param Request $request
     * @return array
     * This function consumes external API using
     * GuzzleHttp\Client
     */
    public function index(Request $request)
    {
        // Validate request
        $this->validate($request, [
            'name' => 'required'
        ]);
        // Create a request using a completely custom HTTP method
        $client = new Client();
        $response = $client->request('GET', 'https://www.anapioficeandfire.com/api/books?name='.$request->name);
        $statusCode = $response->getStatusCode();

        // Get content
        $body = $response->getBody()->getContents();

        // DECODE JSON
        $items = json_decode($body);

        // count array
        if (count($items) >= 1)
        {
            // loop through to access each key/value pair from an array
            foreach ($items as $key => $item) {

                $lists[] = ['status_code' => $items, 'status' => 'success', "data" => ['name' => $item->name, 'isbn' => $item->isbn,
                    'authors' => [$item->authors], 'number_of_pages' => $item->numberOfPages, 'publisher' => $item->publisher,
                        'country' => $item->country, 'release_date' => $item->released]];
            }
            // Dump array

            dump($lists);

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
