<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostalCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('postal_codes', function (Blueprint $table) {
            $table->increments('id');//オートインクリメントで連番
            $table->unsignedInteger('first_code')->index();//郵便番号の始め（３桁）の部分
            $table->unsignedInteger('last_code')->index();//郵便番号の後ろ（４桁）の部分
            $table->string('prefecture');//都道府県名
            $table->string('city');//市区町村
            $table->string('address');//それ移行の住所
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postal_codes');
    }
}
