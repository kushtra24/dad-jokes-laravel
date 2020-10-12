<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JokesController extends Controller
{
    public function index(Request $request) {

        $page = $request->input('current_page', null);
        $limit = $request->input('limit', null);
        $searchTerm = $request->input('term', null);

        $jokes = $this->getJokes($page, $limit, $searchTerm);

        return response()->json($jokes, 200);
    }

    public function getJokes($page, $limit, $searchTerm) {
        $client = new Client(['headers' => ['Accept' => 'application/json']]);
        $url = 'https://icanhazdadjoke.com/search';
        if (isset($page)) {
            $url .= '?page=' . $page;
        }
        if (isset($searchTerm)) {
            $url .= '&term=' . $searchTerm;
        }
        if (isset($limit)) {
            $url .= '&limit=' . $limit;
        }
        Log::info(var_export($url, true));
        $res = $client->request('GET', $url);
        return json_decode($res->getBody()->getContents(), true);
    }

}

