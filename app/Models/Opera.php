<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opera extends Model
{
    protected $table = 'opera';

    protected $fillable = [
        'titolo',
        'immagine',
        'autore',
        'descrizione',
        'categoria',
    ];


    protected $guarded = [];


    protected $appends=[  /*come se avessi un'altra colonna la tabella*/
        'valutazione',
    ];

    public function getValutazioneAttribute()
    {
        $session_id = session('user_id');

        return $this->valutazione()
        ->where('user_id', $session_id)
        ->pluck('valutazione') //seleziona colonne
        ->first(); // prende la prima riga
    }


    public function categorie() {
        return $this->belongsTo('App\Models\Categoria');
    }

    public function creazione() {
        return $this->hasMany('App\Models\Creazione');
    }

    public function valutazione() {
        return $this->hasMany('App\Models\Valutazione');
    }

    public function setImmagineAttribute($value)
    {
        //Se esiste già una foto la rimuovo dallo storage
        if (isset($this->attributes["immagine"]) && Storage::disk("public")->exists($this->attributes["immagine"])) Storage::disk("public")->delete($this->attribute["immagine"]);
        //Salvo il file nello storage e recupero il path
        $path = $value ? Storage::disk("public")->put("operaImage", $value) : null;
        $this->attributes["immagine"] = $path; //salvandolo come attributo del modello
    }

    public function getImmagineAttribute($value)
    {
        // ATTENZIONE -> in questo modo $user->photo non sarà mai NULL
        return ($value) ? Storage::url($value) : asset("images/default.png");
    }
}
