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
        Schema::table('properties', function (Blueprint $table) {
            $table->integer('bedrooms')->nullable()->after('price');
            $table->integer('bathrooms')->nullable()->after('bedrooms');
            $table->decimal('sqft', 10, 2)->nullable()->after('bathrooms');
            $table->boolean('is_featured')->default(false)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['bedrooms', 'bathrooms', 'sqft', 'is_featured']);
        });
    }
};
