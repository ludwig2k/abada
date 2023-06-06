<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprador extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'email', 'senha','cpf','data_nascimento', 'estado', 'cidade', 'creditos'
    ];

    public function compras()
    {
    return $this->hasMany(Compras::class, 'comprador_id');
    }
}
