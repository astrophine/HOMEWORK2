<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Opera;

use App\Models\Categoria;

class CreateController extends Controller
{
    public function index() {
        $session_id = session('user_id');
        $user = User::find($session_id);

        if (!isset($user))
            return view('home');
        else if ($user->numero_opere > -1)
        {
            $categorie = Categoria::all()->pluck('nome')->toArray(); //pluck serve a prendere la colonna nome delle categorie
            $cat = '"' . implode('", "', $categorie) . '"'; //implode prende in ingresso  un array di stringhe e le concatena con il separatore specificato tra le virgolette singole
            return view("create")->with("isartista", true)->with("categorie", $cat); // filippo e giovanni in un array -> "filippo","giovanni"
        } 
        else 
        {
            return view("home")->with("user", $user)->with("user", $user);
        }
    }

    function create_postaOpera()
    {
        $request = request();

        $session_id = session('user_id');
        $myusername = User::find($session_id)->username;
        $pic = $request->has('immagine') ? $request->file('immagine') : null; //verifica che ci sia un immagine se no nulla

        $newOpera=Categoria::find($request['categoria'])->opera()->create(
            [
                'titolo' => $request['titolo'],
                'immagine' => $pic ?? null,
                'autore' => $myusername,
                'descrizione' => $request['descrizione']
            ]                 
        );

        return true;
    }

    function create_scaricaOpere()
    {

        $session_id = session('user_id');
        $myusername = User::find($session_id)->username; //find cerca per id è una select con where id
        
        $opere = Opera::where('autore', $myusername)->get();

        return $opere;
    }


}
