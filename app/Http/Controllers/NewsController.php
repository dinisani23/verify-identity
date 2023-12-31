<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class NewsController extends Controller
{
    public function news()
    {
        $client = new Client();
        $response = $client->get('https://newsapi.org/v2/everything', [
            'query' => [
                'q' => 'identity fraud',
                'apiKey' => '5a87237d073241c69014ec6b9bbae226'
            ]
        ]);
        $articles = json_decode($response->getBody()->getContents())->articles;
         $articles = collect($articles)->take(5);
        return view('dashboard', compact('articles'));
    }
}
