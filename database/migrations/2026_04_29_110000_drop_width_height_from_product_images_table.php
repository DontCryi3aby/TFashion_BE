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
        if (! Schema::hasTable('product_images')) {
            return;
        }

        if (Schema::hasColumn('product_images', 'width')) {
            Schema::table('product_images', function (Blueprint $table) {
                $table->dropColumn(['width', 'height']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('product_images')) {
            return;
        }

        if (! Schema::hasColumn('product_images', 'width')) {
            Schema::table('product_images', function (Blueprint $table) {
                $table->integer('width')->nullable()->after('position');
                $table->integer('height')->nullable()->after('width');
            });
        }
    }
};
