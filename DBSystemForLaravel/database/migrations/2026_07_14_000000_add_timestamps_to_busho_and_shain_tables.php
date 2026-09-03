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
        // 初期マイグレーションでtimestampsを作成済みのため、追加処理は不要です。
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 初期マイグレーションが所有する列のため、削除しません。
    }
};
