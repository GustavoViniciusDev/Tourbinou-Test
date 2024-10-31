<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = ['cidade', 'estado'];

    public function rides() {
        return $this->hasMany(Ride::class, 'destino_id');
    }
}
