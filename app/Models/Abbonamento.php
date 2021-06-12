<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abbonamento extends Model
{
    protected $table = 'abbonamento';

    public function utenti()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function sala()
    {
        return $this->belongsTo('App\Models\Sala');
    }

    protected $guarded = [];
}
