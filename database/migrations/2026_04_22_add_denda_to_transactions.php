<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('denda', 10, 2)->default(0)->after('status');
            $table->integer('hari_terlambat')->default(0)->after('denda');
            $table->date('tanggal_deadline')->nullable()->after('hari_terlambat');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['denda', 'hari_terlambat', 'tanggal_deadline']);
        });
    }
};
