<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'email', 'senha','creditos','status'
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
