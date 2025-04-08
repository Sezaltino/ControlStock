<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    use HasFactory;

    protected $table = 'setores';

    protected $fillable = [
        'nome',
        'descricao',
        'ativo'
    ];

    // Relacionamento com produtos (se necessário)
    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function setor()
    {
        return $this->belongsTo(Setor::class);
    }
    public function lider()
    {
        return $this->hasOne(Lider::class);
    }
}