<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Align products with schema: id, vendor_id (FK), title, body_html, product_type,
     * handle, status, published_at, created_at (no updated_at).
     */
    public function up(): void
    {
        if (! Schema::hasTable('products') || ! Schema::hasTable('vendors')) {
            return;
        }

        if (! Schema::hasColumn('products', 'vendor_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->foreignId('vendor_id')->nullable()->after('id')->constrained('vendors')->restrictOnDelete();
            });
        }

        if (Schema::hasColumn('products', 'vendor_id')) {
            $hasOrphanProducts = DB::table('products')->whereNull('vendor_id')->exists();
            if ($hasOrphanProducts) {
                $vendorId = DB::table('vendors')->orderBy('id')->value('id');
                if (! $vendorId) {
                    $vendorId = DB::table('vendors')->insertGetId([
                        'name' => 'Default Vendor',
                        'email' => 'default@example.test',
                        'phone' => '—',
                        'address' => '—',
                        'logo_url' => '',
                        'status' => 'active',
                        'created_at' => now(),
                    ]);
                }
                DB::table('products')->whereNull('vendor_id')->update(['vendor_id' => $vendorId]);
            }
        }

        if (Schema::hasColumn('products', 'vendor')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('vendor');
            });
        }

        $legacy = array_values(array_filter(
            ['quantity', 'price', 'discount', 'deleted', 'updated_at'],
            fn (string $col) => Schema::hasColumn('products', $col)
        ));

        if ($legacy !== []) {
            Schema::table('products', function (Blueprint $table) use ($legacy) {
                $table->dropColumn($legacy);
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('products')) {
            return;
        }

        if (Schema::hasColumn('products', 'vendor_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropForeign(['vendor_id']);
                $table->dropColumn('vendor_id');
            });
        }

        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'vendor')) {
                $table->string('vendor')->nullable()->after('body_html');
            }
            if (! Schema::hasColumn('products', 'quantity')) {
                $table->integer('quantity')->default(0)->after('vendor');
            }
            if (! Schema::hasColumn('products', 'price')) {
                $table->float('price')->default(0)->after('quantity');
            }
            if (! Schema::hasColumn('products', 'discount')) {
                $table->float('discount')->nullable()->after('price');
            }
            if (! Schema::hasColumn('products', 'deleted')) {
                $table->boolean('deleted')->default(false)->after('discount');
            }
            if (! Schema::hasColumn('products', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }
};
