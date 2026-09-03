<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 社員モデル
 */
class Shain extends Model
{
    /**
     * Eloquent（エロクアント）は、
     * Laravelに標準搭載されている強力なORM（オブジェクトリレーショナルマッパー）です。
     * Eloquentを使用することで、データベースの操作を簡単に行うことができます。
     */

    //all()メソッドを使用して、社員一覧を取得するためのモデル
    protected $table = 'shain'; // テーブル名を指定
    // 主キーを指定
    protected $primaryKey = 'shain_id';
    // 外部キーを指定
    // 外部キーを指定することで、部署テーブルとのリレーションを定義
    protected $foreignKey = 'busho_id';
    // リレーションを定義するためのメソッド
    // bushoという名前のメソッドを定義し、社員モデルと部署モデルのリレーションを定義
    // 使い方: $shain->busho->busho_mei で社員の所属部署名を取得可能
    public function busho()
    {
        // 社員モデルと部署モデルのリレーションを定義
        return $this->belongsTo(Busho::class, 'busho_id', 'busho_id');
        // belongsToメソッドを使用して、社員モデルと部署モデルのリレーションを定義
        // 第一引数に関連するモデルのクラス名を指定
        // 第二引数に外部キーを指定
        // 第三引数に関連するモデルの主キーを指定
        // 第四引数に関連するモデルのテーブル名を指定（省略可能）
        // これにより、社員モデルから部署モデルへのリレーションが定義され、
        // 社員が所属する部署の情報を取得できるようになります。
        // 例: $shain->busho->busho_mei で社員の所属部署名を取得可能
    }

    // created_atとupdated_atの自動管理を無効化
    public $timestamps = false;

    // 変更可能なカラムを指定
    // fillableプロパティを使用して、変更可能なカラムを指定
    protected $fillable = [
        'shain_mei', // 社員名
        'busho_id',  // 部署ID(外部キー)
        'yakushoku', // 役職
        'nyusha_date', // 入社日
        'shain_tel',   // 社員電話番号
        'shain_mail',  // 社員メールアドレス
    ];

    // 全件取得するメソッド
    public static function getAllShain()
    {
        // Eloquent(エロクアント)のall()メソッドを使用して、社員一覧を取得
        return self::all();
    }
}