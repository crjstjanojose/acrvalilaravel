<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Encomenda extends Model
{
    use SoftDeletes;

    protected $fillble = ['nome', 'contato', 'descricao', 'quantidade', 'preco', 'previsao'];

    protected $dates = [
        'previsao',
        'created_at'
    ];

    //protected $dateFormat = 'd/m/Y';

    public function getPrevisaoAttribute()
    {
        return date('d/m/Y', strtotime($this->attributes['previsao']));
    }

    public function setPrevisaoAttribute($value)
    {
        $date_parts = explode('/', $value);
        $this->attributes['previsao'] = $date_parts[2] . '-' . $date_parts[1] . '-' . $date_parts[0];
    }

    public function getCreatedAtAttribute()
    {
        return date('d/m H:m', strtotime($this->attributes['created_at']));
    }

    public function setPrecoAttribute($value)
    {
        $valor = str_replace(',', '.', $value);
        $this->attributes['preco'] = number_format($valor, 2, '.', ',');
    }

    public function getPrecoAttribute()
    {
        return number_format($this->attributes['preco'], 2, ',', '.');
    }


    public function userCriacao()
    {
        return $this->hasOne('App\User', 'id', 'user_criacao');
    }

    public function userConfirmacao()
    {
        return $this->belongsTo('App\User', 'user_confirmacao', 'id');
    }

    public function userSolicitacao()
    {
        return $this->belongsTo('App\User', 'user_solicitacao', 'id');
    }

    public function userExclusao()
    {
        return $this->belongsTo('App\User', 'user_exclusao', 'id');
    }
}
