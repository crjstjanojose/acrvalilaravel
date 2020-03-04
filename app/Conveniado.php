<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conveniado extends Model
{
    use SoftDeletes;


    protected $fillble = [
        'convenio_id', 'user_id', 'user_edicao', 'user_exclusao', 'nome', 'cpf',
        'email', 'telefone', 'telefone_secundario', 'situacao', 'endereco', 'bloco', 'apartamento',
        'observacao', 'credito', 'observacao_administracao'
    ];
}
