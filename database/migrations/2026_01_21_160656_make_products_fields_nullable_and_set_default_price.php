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
        Schema::table('products', function (Blueprint $table) {
            // Hacer nullable los campos excepto nombre
            $table->decimal('precio', 10, 2)->nullable()->default(0)->change();
            $table->string('dosis')->nullable()->change();
            $table->string('cultivo')->nullable()->change();
            $table->string('etapa')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Revertir cambios
            $table->decimal('precio', 10, 2)->nullable(false)->default(null)->change();
            $table->string('dosis')->nullable(false)->change();
            $table->string('cultivo')->nullable(false)->change();
            $table->string('etapa')->nullable(false)->change();
        });
    }
};
