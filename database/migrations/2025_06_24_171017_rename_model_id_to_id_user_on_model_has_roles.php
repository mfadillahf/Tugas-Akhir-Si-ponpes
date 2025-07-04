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
        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->renameColumn('model_id', 'id_user');
        });

        Schema::table('model_has_permissions', function (Blueprint $table) {
            $table->renameColumn('model_id', 'id_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->renameColumn('id_user', 'model_id');
        });

        Schema::table('model_has_permissions', function (Blueprint $table) {
            $table->renameColumn('id_user', 'model_id');
        });
    }
};
