<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;

    public function vendedor()
    {
    return $this->belongsTo(Vendedor::class);
    }

    public function comprador()
    {
    return $this->belongsTo(Comprador::class);
    }

    public function produto()
    {
    return $this->belongsTo(Produto::class);
        }
}
