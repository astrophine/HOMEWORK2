<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creazione extends Model
{
    protected $table = 'creazione';

    protected $guarded=[];
    
    public function user() {
        return $this->belongsTo("App\Models\User");
    }
    public function opera() {
        return $this->belongsTo("App\Models\Opera");
    }
    public function sale() {
        return $this->belongsTo("App\Models\Sale");
    }

}
