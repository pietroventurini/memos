<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemShoplistUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_shoplist_user', function (Blueprint $table) {
            $table->integer('item_id')->unsigned();
            $table->integer('shoplist_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->primary(['item_id', 'shoplist_id', 'user_id']);

            $table->integer('quantity')->unsigned()->default(1);
            $table->boolean('checked')->default(false);
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('item')->onDelete('cascade');
            $table->foreign('shoplist_id')->references('id')->on('shoplist')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_shoplist_user');
    }
}
