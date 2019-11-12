<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        error_log("testing crawler");
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
        ));
        $goutteClient->setClient($guzzleClient);
        $crawler = $goutteClient->request('GET', 'https://duckduckgo.com/html/?q=Laravel');

        var_dump($crawler->filter('.result__title .result__a')->each(function ($node) {
            $temp = $node->text();
            // dump($temp);
            $titles[] = ($temp);
            return $temp;
        }));

        return view('pages.home');
    }
}
