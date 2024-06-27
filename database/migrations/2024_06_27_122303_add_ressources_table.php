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
      // add ressource
      Schema::create('ressources', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->string('path');
          $table->timestamps();
      });
      Schema::table('posts', function (Blueprint $table) {
          $table->foreignId('ressource_id')->nullable()->constrained('ressources')->onDelete('set null');
      });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('ressources');
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('ressource_id');
        });
    }
};
