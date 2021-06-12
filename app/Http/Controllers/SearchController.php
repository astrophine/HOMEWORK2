<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class SearchController extends Controller
{

    public function index() {
        $session_id = session('user_id');
        $user = User::find($session_id);

        if (!isset($user))
            return view('home');
        else if ($user->numero_opere > -1)
            return view("search")->with("isartista", true)->with("user", $user);
        else
            return view("search")->with("user", $user);
    }

    function search_spotify(Request $request) {   
        $token = Http::asForm()->withHeaders([
            'Authorization' => 'Basic '.base64_encode(env('SPOTIFY_CLIENT_ID').':'.env('SPOTIFY_CLIENT_SECRET')),
        ])->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'client_credentials',
        ]);
        if ($token->failed()) abort(500);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token['access_token']
        ])->get('https://api.spotify.com/v1/search', [
            'type' => 'track',
            'q' => $request->q
        ]);
        if($response->failed()) abort(500);

        return $response->body();
    }   

    function search_immagine(Request $request)
    {
        $album = Http::get("https://collectionapi.metmuseum.org/public/collection/v1/search",
            [
                "q" => $request->ricerca
            ]
        );
        
    
        $num_results = $album["total"];
        if ($num_results > 5) $num_results = 5;
    
        $chosen_albums_idx = array_rand($album["objectIDs"], $num_results); //indici random per dare sempre risultati diversi 
    
        $result = array();
        foreach ($chosen_albums_idx as $idx) {
            $id_opera = $album["objectIDs"][$idx];
            $opera = Http::get("https://collectionapi.metmuseum.org/public/collection/v1/objects/".$id_opera);
            
            $opera_elaborata = array(
                "titolo" => $opera["title"],
                "immagine" => $opera["primaryImageSmall"],
                "autore" => $opera["artistDisplayName"]
            );
            array_push($result, $opera_elaborata);
        }
        return response()->json($result);
    }

    function search_utente(Request $request)
    {
        $session_id = session('user_id');
        $myusername = User::find($session_id)->username;
        $query = $request->username;

        $res = User::query()->where('numero_opere', '>', -1)->where('username', '!=', $myusername)->where("username","LIKE","%{$query}%")->get();

        $users = array();
        foreach ($res as $r) {
            $users[]=array('artista'=> $r['username'], 'immagine'=> $r['immagine']);
        }
        
        return response()->json($users);
    }
}
