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
        Schema::table('grupo_musical', function (Blueprint $table) {
            $table->text('logo')->nullable()->after('avatar');
            $table->text('video_url')->nullable()->after('logo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grupo_musical', function (Blueprint $table) {
            $table->dropColumn(['logo', 'video_url']);
        });
    }
};
