<?php

use App\Models\Product;
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
        Schema::create('product_histories', function (Blueprint $table) {
            $table->id();
            $table->string('reg_no')->unique();
            $table->foreignIdFor(Product::class)->constrained();
            $table->foreignIdFor(\App\Models\Supplier::class)->nullable()->constrained();
            $table->string('supplier_reg_no')->nullable();
            $table->integer('before');
            $table->integer('after');
            $table->integer('change');
            $table->integer('change_type');
            $table->string('note')->nullable();
            $table->dateTime('action_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_histories');
    }
};
