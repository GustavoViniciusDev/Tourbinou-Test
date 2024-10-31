<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'horario',
        'destino_id',
        'descricao',
        'imagem',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destino_id');
    }
}
