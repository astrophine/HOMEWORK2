<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Creazione;
use App\Models\Sala;
use App\Models\Abbonamento;



class GalleryController extends Controller
{


    public function index() {
        $session_id = session('user_id');
        $user = User::find($session_id);

        if (!isset($user))
            return view('home');
        else if ($user->numero_opere > -1)
            return view("gallery")->with("isartista", true)->with("user", $user);
        else
            return view("gallery")->with("user", $user);
    }

    public function creaGalleria()
    {
        $request = request();

        $session_id = session('user_id');
        $myusername = User::find($session_id)->username;
        $pic = $request->has('immagine') ? $request->file('immagine') : null;
        $id_opere=json_decode($request['id_opere'],true);


        $newSala =  Sala::create([
            'nome' => $request['titolo'],
            'immagine' => $pic ?? null,
            'descrizione' => $request['descrizione'],
            ]);
        foreach ($id_opere as $id)
        {
            Creazione::create([
                'user_id' => $session_id,
                'opera_id' => $id,
                'sala_id' => $newSala->id,
                ]);
        }
        return true;
 
    }

    public function gallery_fineAbbonamento()
    {
        $request = request();

        $session_id = session('user_id');
        $myusername = User::find($session_id)->username;
        $data_fine = now();

        $affected = Abbonamento::query()
        ->where('sala_id', $request['postid'])
        ->where('user_id', $session_id)
        ->where('data_fine', null)
        ->update(['data_fine' => $data_fine]);
       
        return true;
    }

    public function gallery_inizioAbbonamento()
    {
        $request = request();

        $session_id = session('user_id');
        $myusername = User::find($session_id)->username;
        $data_inizio = now();

        $newAbbonamento =  Abbonamento::create([
            'sala_id' => $request['postid'],
            'data_inizio' => $data_inizio,
            'data_fine' => NULL,
            'user_id' => $session_id,
            ]);
        
        return true;
       
    }


    public function gallery_scaricaSale()
    {
        return Sala::all();
    }

    public function gallery_cercaSale(Request $request)
    {
        $query = $request->q;

        return Sala::query()->where("nome","LIKE","%{$query}%")->get();
    }
}
