<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    public $timestamps = false;//マスタデータとして使用するので不要とのことだったので、timestampsをfalseに指定。
    protected $guarded = ['id'];//データ追加時に思わぬエラーが起きないようidを指定
}
