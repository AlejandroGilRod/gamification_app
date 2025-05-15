<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'attribute_points')) {
                $table->integer('attribute_points')->default(0);
            }
            if (!Schema::hasColumn('users', 'defensa')) {
                $table->integer('defensa')->default(0);
            }
            if (!Schema::hasColumn('users', 'fuerza')) {
                $table->integer('fuerza')->default(0);
            }
            if (!Schema::hasColumn('users', 'inteligencia')) {
                $table->integer('inteligencia')->default(0);
            }
            // Elimina si existe un campo mal llamado
            if (Schema::hasColumn('users', 'vida')) {
                $table->dropColumn('vida');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['attribute_points', 'defensa', 'fuerza', 'inteligencia']);
            $table->integer('vida')->default(0); // si quieres restaurarla
        });
    }
};
