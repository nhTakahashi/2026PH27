<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 部署モデル
 */
class Busho extends Model
{
    //all()メソッドを使用して、部署一覧を取得するためのモデル
    protected $table = 'busho'; // テーブル名を指定

    protected $fillable = [
        'busho_mei', // 部署名
    ];
    // 全件取得するメソッド
    public static function getAllBusho()
    {
        return self::all();
    }
}
