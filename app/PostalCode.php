<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    public function up()
    {
        Schema::create('postal_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('first_code')->index();
            $table->unsignedInteger('last_code')->index();
            $table->string('prefecture');
            $table->string('city');
            $table->string('address');
        });
    }
}
