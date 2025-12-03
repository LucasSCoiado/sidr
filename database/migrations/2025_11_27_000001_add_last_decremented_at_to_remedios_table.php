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
        Schema::table('remedios', function (Blueprint $table) {
            $table->timestamp('last_decremented_at')->nullable()->after('qtdRestante');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('remedios', function (Blueprint $table) {
            $table->dropColumn('last_decremented_at');
        });
    }
};
