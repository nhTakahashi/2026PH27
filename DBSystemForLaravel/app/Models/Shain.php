<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 社員モデル
 */
class Shain extends Model
{
    // 実際の社員テーブル名を指定します。
    protected $table = 'shain';

    // 主キーが標準のidではないため、社員IDの列名を指定します。
    protected $primaryKey = 'shain_id';

    // 1人の社員は1つの部署に所属するため、belongsToリレーションを定義します。
    public function busho()
    {
        return $this->belongsTo(Busho::class, 'busho_id', 'busho_id');
    }

    // フォームから保存・更新できる社員情報を限定します。
    protected $fillable = [
        'shain_mei',
        'mail_address',
        'password',
        'busho_id',
        'yakushoku',
        'nyusha_bi',
        'kyuyo',
    ];

    protected function casts(): array
    {
        // 入社日を日付として扱い、給与を整数として扱えるようにします。
        return ['nyusha_bi' => 'date', 'kyuyo' => 'integer'];
    }
}