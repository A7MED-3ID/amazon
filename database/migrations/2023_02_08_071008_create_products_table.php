<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer("brand_id");
            $table->integer("category_id");
            $table->integer("subcategory_id");
            $table->string("name");
            $table->string("slug");
            $table->string("code");
            $table->string("quantity");
            $table->string("tags")->nullable();
            $table->string("size")->nullable();
            $table->string("color")->nullable();
            $table->string("selling_price");
            $table->string("discount_price")->nullable();
            $table->text("short_desc");
            $table->text("long_desc");
            $table->string("product_thambnail");
            $table->integer("vendor_id")->nullable();
            $table->string("hot_deals")->nullable();
            $table->string("featured")->nullable();
            $table->string("special_offer")->nullable();
            $table->string("special_deals")->nullable();
            $table->enum("status",["active","inactive"])->default("active");
           









            



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
