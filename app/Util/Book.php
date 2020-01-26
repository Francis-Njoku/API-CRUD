<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 25/01/2020
 * Time: 00:19
 */
namespace App\Util;

use GuzzleHttp\Client;

class Book
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function all()
    {
        return $this->endpointRequest('/book/posts');

    }

    public function findById($id)
    {
        return $this->endpointRequest('/book/posts/'.$id);
    }

    public function endpointRequest($url)
    {
        try {
            $response = $this->client->request('GET', $url);
        } catch (\Exception $e)
        {
            return [];
        }

        return $this->response_handler($response->getBody()->getContents());
    }

    public function response_handler ($response)
    {
        if ($response) {
            return json_decode($response);
        }

        return [];
    }
}