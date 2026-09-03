<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 部署モデル
 */
class Busho extends Model
{
    /**
     * Eloquent（エロクアント）は、
     * Laravelに標準搭載されている強力なORM（オブジェクトリレーショナルマッパー）です。
     * Eloquentを使用することで、データベースの操作を簡単に行うことができます。
     */

    //all()メソッドを使用して、部署一覧を取得するためのモデル
    protected $table = 'busho'; // テーブル名を指定
    // 主キーを指定
    protected $primaryKey = 'busho_id';
    // created_atとupdated_atの自動管理を無効化
    public $timestamps = false;

    // 変更可能なカラムを指定
    // fillableプロパティを使用して、変更可能なカラムを指定
    protected $fillable = [
        'busho_mei', // 部署名
    ];
    // 全件取得するメソッド
    public static function getAllBusho()
    {
        // Eloquent(エロクアント)のall()メソッドを使用して、部署一覧を取得
        return self::all();
    }
}
