<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjustmentsTable extends Migration
{
    public function up()
    {
        Schema::create('adjustments', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('ref_id')->unique();
            $table->unsignedBigInteger('warehouse_id'); // Foreign key
            $table->integer('total_products');
            $table->text('details');
            $table->timestamps();

            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('adjustments');
    }
}
