<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('attribute_points')->default(0);
            $table->integer('vida')->default(0);
            $table->integer('fuerza')->default(0);
            $table->integer('inteligencia')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['attribute_points', 'vida', 'fuerza', 'inteligencia']);
        });
    }
};
