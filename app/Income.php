<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $table = 'incomes';
    public function type() {
        return $this->belongsTo('App\Type', 'type_id','id');
    }
}
