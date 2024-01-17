<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ApiQuotesConnectionController extends Controller
{
    public $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fiveRandomQuotes()
    {
        $response = $this->client->get( 
            'https://quotes.rest/quote/random',
            [
                'headers' => [
                    'Authorization' => 'Bearer '. env('QUOTE_API_KEY'),
                ],
                'limit' => 5,
            ],
        );
        $data = json_decode($response->getBody(), true);
        $quotes = $data['contents']['quotes'];
        return $quotes;
    }

    public function randomQuotesByKayneWest($limit)
    {
        $response = $this->client->get(
            'https://quotes.rest/quote/search',
            [
                'headers' => [
                    'Authorization' => 'Bearer '. env('QUOTE_API_KEY'),
                ],
                'limit' => $limit,
                'author' => 'Kayne West',
            ],
        );
        $data = json_decode($response->getBody(), true);
        $quotes = $data['contents']['quotes'];
        return $quotes;
    }

    public function refreshQuotes()
    {
        return $this->fiveRandomQuotes();
    }
}
