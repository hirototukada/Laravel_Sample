<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    public function up()
    {
            public $timestamps = false;
            protected $guarded = ['id'];
    }
}
