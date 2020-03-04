<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    use SoftDeletes;

    protected $fillble = ['denominacao', 'user_id', 'situacao'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
