<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 部署モデル
 */
class Busho extends Model
{
    // Laravelの複数形の自動推測を使わず、実際のテーブル名を指定します。
    protected $table = 'busho';

    // 主キーが標準のidではないため、部署IDの列名を指定します。
    protected $primaryKey = 'busho_id';

    // create()やupdate()で代入できる列を限定します。
    protected $fillable = [
        'busho_mei',
    ];

    // 1つの部署には複数の社員が所属するため、hasManyリレーションを定義します。
    public function shain()
    {
        return $this->hasMany(Shain::class, 'busho_id', 'busho_id');
    }
}
