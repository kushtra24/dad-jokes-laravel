<?php

namespace App\Http\Controllers;
use App\Models\Joke;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class JokesController extends Controller
{
    public function index() {
        $jokes = $this->getJokes();

        return response()->json($jokes, 200);
    }

    public function getJokes() {
        $client = new Client(['headers' => ['Accept' => 'application/json']]);
        $res = $client->request('GET', 'https://icanhazdadjoke.com/search');
        $data = json_decode($res->getBody()->getContents(), true);
        return $data;
    }

}



//$data = json_decode($res->getBody()->getContents(),true);
//$events = $data['Data'];
//foreach($events as $item)
//{
//    DB::table('your_table')->insert(['timeLive'=>$item['timeLive']])
//}
