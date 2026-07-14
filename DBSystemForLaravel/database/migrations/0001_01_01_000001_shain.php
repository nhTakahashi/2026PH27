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
        // 社員（shain）／ busho_id で部署を参照
        Schema::create('shain', function (Blueprint $table) {
            $table->id("shain_id");                        // 社員ID（主キー）
            $table->string("shain_mei", 50);               // 社員名
            $table->string("mail_address", 100)->unique(); // メールアドレス
            $table->string("password", 255);               // パスワード
            $table->foreignId("busho_id")->nullable()      // 部署ID（外部キー）
                ->constrained("busho", "busho_id");
            $table->string("yakushoku", 30)->nullable();   // 役職
            $table->date("nyusha_bi")->nullable();         // 入社日
            $table->integer("kyuyo")->nullable();          // 給与
            $table->timestamps();                          // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shain');
    }
};
