<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// php artisan make:seeder ShainSeeder
class ShainSeeder extends Seeder
{
    use WithoutModelEvents;
    public function run()
    {
        // 部署マスタ（busho）
        DB::table("busho")->insert([
            ["busho_mei" => "営業部"],
            ["busho_mei" => "開発部"],
            ["busho_mei" => "総務部"],
            ["busho_mei" => "人事部"],
        ]);
        // 社員（shain）
        DB::table("shain")->insert([
            /* INSERT INTO shain
             *    (shain_mei, mail_address, password, busho_id, yakushoku, nyusha_bi, kyuyo) VALUES
             *    ('山田 太郎', 'yamada@example.com',     'pass1234', 2, '主任', '2018-04-01', 320000),
             *    ('佐藤 花子', 'sato@example.com',       'pass1234', 1, '一般', '2020-04-01', 280000),
             *    ('鈴木 一郎', 'suzuki@example.com',     'pass1234', 2, '課長', '2012-04-01', 450000),
             *    ('田中 美咲', 'tanaka@example.com',     'pass1234', 3, '一般', '2021-10-01', 270000),
             *    ('高橋 健',   'takahashi@example.com',  'pass1234', 4, '部長', '2008-04-01', 600000);
             */
            [
                "shain_mei" => "山田 太郎",
                "mail_address" => "yamada@example.com",
                "password" => "pass1234",
                "busho_id" => 2,
                "yakushoku" => "主任",
                "nyusha_bi" => "2018-04-01",
                "kyuyo" => 320000
            ],
            [
                "shain_mei" => "佐藤 花子",
                "mail_address" => "sato@example.com",
                "password" => "pass1234",
                "busho_id" => 1,
                "yakushoku" => "一般",
                "nyusha_bi" => "2020-04-01",
                "kyuyo" => 280000
            ],
            [
                "shain_mei" => "鈴木 一郎",
                "mail_address" => "suzuki@example.com",
                "password" => "pass1234",
                "busho_id" => 2,
                "yakushoku" => "課長",
                "nyusha_bi" => "2012-04-01",
                "kyuyo" => 450000
            ],
            [
                "shain_mei" => "田中 美咲",
                "mail_address" => "tanaka@example.com",
                "password" => "pass1234",
                "busho_id" => 3,
                "yakushoku" => "一般",
                "nyusha_bi" => "2021-10-01",
                "kyuyo" => 270000
            ],
            [
                "shain_mei" => "高橋 健",
                "mail_address" => "takahashi@example.com",
                "password" => "pass1234",
                "busho_id" => 4,
                "yakushoku" => "部長",
                "nyusha_bi" => "2008-04-01",
                "kyuyo" => 600000
            ]
        ]);
    }
}
// php artisan db:seed --class=ShainSeeder で実行