<?php
/**
 * Created by Sebastian Lewandowski<sebasolew@gmail.com>.
 * Date: 12.04.2018
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('amount');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('products');
    }
}