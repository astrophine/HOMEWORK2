<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valutazione extends Model
{
    protected $table = "valutazione";

    protected $guarded = [];

    public function utenti() {
        return $this->belongsTo('App\Models\User');
    }

    public function opere() {
        return $this->belongsTo('App\Models\Opera');   
     }

     

}
