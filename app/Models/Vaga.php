<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    protected $table = 'vaga';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'numero', 'ocupada', 'horario_entrada', 'horario_saida', 'preco','usuario_id',
    ];

    // Relacionamento de uma vaga para um usuário
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
