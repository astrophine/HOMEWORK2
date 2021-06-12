<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sala;
use App\Models\Valutazione;


class HomeController extends Controller
{
    public function index(Request $request) {
        $session_id = session('user_id');
        $user = User::find($session_id);

        if (!isset($user))
            return view('home');
        else if ($user->numero_opere > -1)
            return view("home")->with("isartista", true)->with("user", $user);
        else 
            if (isset($request['sala']))
                return view("home")->with("user", $user)->with("sala",$request['sala']);
            else
                return view("home")->with("user", $user);
        
    }

    public function home_scaricaOpereSala(Request $request)
    {
        if(!isset($request['sala']))
        {
            $session_id = session('user_id');
            $user = User::find($session_id);
            
            $opere = array();
            foreach ($user->abbonamenti()->where('data_fine', null)->get() as $abbonamento) //per ogni abbonamento per la lista di abbonamenti
                foreach ($abbonamento->sala()->first()->creazione()->get() as $creazione) //prendiamo la sala a cui si riferisce
                    $opere[] = $creazione->opera()->first(); // in creazione ci sono le opere e prendiamo la prima riga
            
            return collect($opere);
        }else
        {
            $opere = array();

            foreach(Sala::find($request['sala'])->creazione()->get() as $creazione)
                $opere[] = $creazione->opera()->first();
            
            return collect($opere);
        }

    }

    public function home_inserimentovalutazione(Request $request)
    {

        $session_id = session('user_id');

        Valutazione::upsert([[
            'user_id' => $session_id,
            'opera_id' => $request['opera'],
            'valutazione' => $request['stellaid'],
        ]], ['user_id','opera_id'], ['valutazione']); //creazione con chiavi uniche user id e opera se esistono aggiorna valutazione
        

        return true;
        
    }


   
}
