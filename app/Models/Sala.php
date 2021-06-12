<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table = 'sala';

    protected $fillable = [
        'nome',
        'immagine',
        'descrizione',
    ];
    protected $appends=[ /*aggiunge una colonna*/ 
        'isabbonato',
    ];

    public function getIsabbonatoAttribute()
    {
        $session_id = session('user_id');
        $data_fine = now();

        return $this->abbonamenti()
        ->where('user_id', $session_id)
        ->where('data_fine', null)
        ->get()
        ->isNotEmpty(); /*verifica che non ci sia alcun abbonamento in corso*/
        /*true->c'è un abbonamento */ 
    }
    public function abbonamenti() {
        return $this->hasMany('App\Models\Abbonamento');
    }

    public function creazione() {
        return $this->hasMany('App\Models\Creazione');
    }
    public function setImmagineAttribute($value)
    {
        //Se esiste già una foto la rimuovo dallo storage
        if (isset($this->attributes["immagine"]) && Storage::disk("public")->exists($this->attributes["immagine"])) Storage::disk("public")->delete($this->attribute["immagine"]);
        //Salvo il file nello storage e recupero il path
        $path = $value ? Storage::disk("public")->put("salaImage", $value) : null;
        $this->attributes["immagine"] = $path; //salvandolo come attributo del modello
    }

    public function getImmagineAttribute($value)
    {
        // ATTENZIONE -> in questo modo $user->photo non sarà mai NULL
        return ($value) ? Storage::url($value) : asset("images/default.png");
    }
}
