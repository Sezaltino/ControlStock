<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lider extends Model
{
    use HasFactory;

    protected $table = 'lideres';
    
    protected $fillable = [
        'nome',
        'email',
        'setor_id',
        'user_id',
        'ativo'
    ];

    /**
     * Obter o setor associado ao líder.
     */
    public function setor()
    {
        return $this->belongsTo(Setor::class);
    }

    /**
     * Obter o usuário associado ao líder, se houver.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}