<?php

namespace App\Http\Controllers;
use App\Models\Joke;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JokesController extends Controller
{
    public function index(Request $request) {

        $page = $request->input('current_page', null);

        $jokes = $this->getJokes($page);

        $result = $jokes;

        return response()->json($jokes, 200);
    }

    public function getJokes($page) {
        $client = new Client(['headers' => ['Accept' => 'application/json']]);
        $res = $client->request('GET', 'https://icanhazdadjoke.com/search?page=' . $page);
        $data = json_decode($res->getBody()->getContents(), true);
        return $data;
    }

}

