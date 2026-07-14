<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('busho', function (Blueprint $table) {
            $table->id("busho_id");            // 部署ID（自動採番）
            $table->string("busho_mei", 50);   // 部署名
            $table->timestamps();              // created_at(作成日時), updated_at(更新日時)
        });
    }

    /**
     * Reverse the migrations.
     * downしたい場合は、php artisan migrate:rollback で戻せる
     * ただし、shainテーブルがbushoテーブルを参照しているため、shainテーブルを先に削除する必要がある
     * そのため、shainテーブルのdownメソッドで、shainテーブルを削除してから、bushoテーブルを削除するようにする
     * もし、shainテーブルを削除せずにbushoテーブルを削除しようとすると、外部キー制約違反でエラーになる
     * 
     */
    public function down(): void
    {
        Schema::dropIfExists('busho');
    }
};
