<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('products', 'description') && ! Schema::hasColumn('products', 'body_html')) {
            Schema::table('products', function (Blueprint $table) {
                $table->renameColumn('description', 'body_html');
            });
        }

        if (! Schema::hasColumn('products', 'vendor')) {
            $after = Schema::hasColumn('products', 'body_html') ? 'body_html' : 'title';
            Schema::table('products', function (Blueprint $table) use ($after) {
                $table->string('vendor')->nullable()->after($after);
            });
        }

        if (! Schema::hasColumn('products', 'product_type')) {
            $after = Schema::hasColumn('products', 'vendor') ? 'vendor' : (Schema::hasColumn('products', 'body_html') ? 'body_html' : 'title');
            Schema::table('products', function (Blueprint $table) use ($after) {
                $table->string('product_type')->nullable()->after($after);
            });
        }

        if (! Schema::hasColumn('products', 'handle')) {
            $after = Schema::hasColumn('products', 'product_type') ? 'product_type' : (Schema::hasColumn('products', 'vendor') ? 'vendor' : 'title');
            Schema::table('products', function (Blueprint $table) use ($after) {
                $table->string('handle')->nullable()->unique()->after($after);
            });
        }

        if (! Schema::hasColumn('products', 'status')) {
            $after = Schema::hasColumn('products', 'handle') ? 'handle' : 'title';
            Schema::table('products', function (Blueprint $table) use ($after) {
                $table->string('status', 32)->default('active')->after($after);
            });
        }

        if (! Schema::hasColumn('products', 'published_at')) {
            $after = Schema::hasColumn('products', 'status') ? 'status' : 'title';
            Schema::table('products', function (Blueprint $table) use ($after) {
                $table->dateTime('published_at')->nullable()->after($after);
            });
        }

        $legacyFeColumns = [
            'sku',
            'subtitle',
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
        ];

        $toDrop = array_values(array_filter($legacyFeColumns, fn (string $col) => Schema::hasColumn('products', $col)));

        if ($toDrop !== []) {
            Schema::table('products', function (Blueprint $table) use ($toDrop) {
                $table->dropColumn($toDrop);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('products', 'published_at')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('published_at');
            });
        }

        if (Schema::hasColumn('products', 'vendor')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('vendor');
            });
        }

        if (Schema::hasColumn('products', 'body_html') && ! Schema::hasColumn('products', 'description')) {
            Schema::table('products', function (Blueprint $table) {
                $table->renameColumn('body_html', 'description');
            });
        }

        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'sku')) {
                $table->string('sku')->nullable();
            }
            if (! Schema::hasColumn('products', 'subtitle')) {
                $table->text('subtitle')->nullable();
            }
            if (! Schema::hasColumn('products', 'tags')) {
                $table->json('tags')->nullable();
            }
            if (! Schema::hasColumn('products', 'gender')) {
                $table->json('gender')->nullable();
            }
            if (! Schema::hasColumn('products', 'colors')) {
                $table->json('colors')->nullable();
            }
            if (! Schema::hasColumn('products', 'selected_sizes')) {
                $table->json('selected_sizes')->nullable();
            }
            if (! Schema::hasColumn('products', 'sale_enabled')) {
                $table->boolean('sale_enabled')->default(false);
            }
            if (! Schema::hasColumn('products', 'sale_label')) {
                $table->string('sale_label')->nullable();
            }
            if (! Schema::hasColumn('products', 'new_enabled')) {
                $table->boolean('new_enabled')->default(false);
            }
            if (! Schema::hasColumn('products', 'new_label')) {
                $table->string('new_label')->nullable();
            }
            if (! Schema::hasColumn('products', 'compare_at_price')) {
                $table->decimal('compare_at_price', 10, 2)->nullable();
            }
            if (! Schema::hasColumn('products', 'includes_tax')) {
                $table->boolean('includes_tax')->default(false);
            }
            if (! Schema::hasColumn('products', 'tax_percent')) {
                $table->decimal('tax_percent', 5, 2)->nullable();
            }
        });
    }
};
