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
        Schema::table('kepengurusans', function (Blueprint $table) {
            $table->string('foto', 100)->nullable()->after('jabatan'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kepengurusans', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};
