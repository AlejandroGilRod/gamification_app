<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'vida')) {
                $table->dropColumn('vida');
            }

            if (!Schema::hasColumn('users', 'defensa')) {
                $table->integer('defensa')->default(0);
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'defensa')) {
                $table->dropColumn('defensa');
            }

            $table->integer('vida')->default(0);
        });
    }
};

