<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Esemplare extends Model
{
    protected $table = 'esemplare';

    public function opere() {
        return $this->belongsTo('App\Models\Opera');    }
}
