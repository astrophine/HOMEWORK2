<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';

    public function opera() {
        return $this->hasMany('App\Models\Opera');
    }

    protected $guarded = [];
}
