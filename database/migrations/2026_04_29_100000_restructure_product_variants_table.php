<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Align legacy product_variants rows with the attributes-based schema.
     */
    public function up(): void
    {
        if (! Schema::hasTable('product_variants')) {
            return;
        }

        Schema::table('product_variants', function (Blueprint $table) {
            if (! Schema::hasColumn('product_variants', 'attributes')) {
                $table->json('attributes')->nullable()->after('product_id');
            }
        });

        $drop = [];
        foreach (['title', 'inventory_policy', 'fulfillment_service', 'weight_unit', 'taxable', 'updated_at'] as $col) {
            if (Schema::hasColumn('product_variants', $col)) {
                $drop[] = $col;
            }
        }

        if ($drop !== []) {
            Schema::table('product_variants', function (Blueprint $table) use ($drop) {
                $table->dropColumn($drop);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('product_variants')) {
            return;
        }

        Schema::table('product_variants', function (Blueprint $table) {
            if (! Schema::hasColumn('product_variants', 'title')) {
                $table->string('title')->nullable()->after('product_id');
            }
            if (! Schema::hasColumn('product_variants', 'inventory_policy')) {
                $table->string('inventory_policy')->default('deny')->after('inventory_quantity');
            }
            if (! Schema::hasColumn('product_variants', 'fulfillment_service')) {
                $table->string('fulfillment_service')->default('manual')->after('inventory_policy');
            }
            if (! Schema::hasColumn('product_variants', 'weight_unit')) {
                $table->string('weight_unit')->nullable()->after('weight');
            }
            if (! Schema::hasColumn('product_variants', 'taxable')) {
                $table->boolean('taxable')->default(true)->after('weight_unit');
            }
            if (! Schema::hasColumn('product_variants', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });

        if (Schema::hasColumn('product_variants', 'attributes')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->dropColumn('attributes');
            });
        }
    }
};
