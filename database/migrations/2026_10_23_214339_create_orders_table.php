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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // boules_de_neige, nounours, parfums, cadeaux
            $table->unsignedBigInteger('product_id');
            
            // زدنا هادو باش نحفظو سمية وتصويرة المنتج
            $table->string('product_name'); 
            $table->string('product_image'); 
            
            $table->string('name');
            $table->string('phone');
            $table->enum('city', ['Casablanca', 'Rabat', 'Marrakech', 'Tanger', 'Agadir', 'Autre'])->default('Casablanca');
            $table->text('address');
            
            // الحوايج اللي زدنا:
            $table->decimal('shipping_fee', 8, 2)->default(20.00); 
            $table->decimal('total_price', 10, 2); 
            
            // حالة الطلب (جديد، مقبول، مرفوض)
            $table->enum('status', ['pending', 'accepted', 'refused'])->default('pending'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};