<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'nome',
        'cognome',
        'immagine',
        'numero_opere',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setImmagineAttribute($value)
    {
        //Se esiste già una foto la rimuovo dallo storage
        if (isset($this->attributes["immagine"]) && Storage::disk("public")->exists($this->attributes["immagine"])) Storage::disk("public")->delete($this->attribute["immagine"]);
        //Salvo il file nello storage e recupero il path
        $path = $value ? Storage::disk("public")->put("userImage", $value) : null;
        $this->attributes["immagine"] = $path; //salvandolo come attributo del modello
    }

    public function getImmagineAttribute($value)
    {
        // ATTENZIONE -> in questo modo $user->photo non sarà mai NULL
        return ($value) ? Storage::url($value) : asset("images/default.png");
    }

    public function creazione() {
        return $this->hasMany('App\Models\Creazione');
    }
    public function abbonamenti() {
        return $this->hasMany('App\Models\Abbonamento');
    }
}
