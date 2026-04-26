<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Shopify-style product fields aligned with admin FE (products-create.tsx).
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('handle')->nullable()->unique()->after('title');
            $table->string('sku')->nullable()->after('handle');
            $table->text('subtitle')->nullable()->after('sku');
            $table->string('product_type', 100)->nullable()->after('title');
            $table->json('tags')->nullable()->after('discount');
            $table->json('gender')->nullable()->after('tags');
            $table->json('colors')->nullable()->after('gender');
            $table->json('selected_sizes')->nullable()->after('colors');
            $table->boolean('sale_enabled')->default(false)->after('selected_sizes');
            $table->string('sale_label')->nullable()->after('sale_enabled');
            $table->boolean('new_enabled')->default(false)->after('sale_label');
            $table->string('new_label')->nullable()->after('new_enabled');
            $table->decimal('compare_at_price', 10, 2)->nullable()->after('new_label');
            $table->boolean('includes_tax')->default(false)->after('compare_at_price');
            $table->decimal('tax_percent', 5, 2)->nullable()->after('includes_tax');
            $table->string('status', 20)->default('active')->after('tax_percent');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'handle',
                'sku',
                'subtitle',
                'product_type',
                'tags',
                'gender',
                'colors',
                'selected_sizes',
                'sale_enabled',
                'sale_label',
                'new_enabled',
                'new_label',
                'compare_at_price',
                'includes_tax',
                'tax_percent',
                'status',
            ]);
        });
    }
};
