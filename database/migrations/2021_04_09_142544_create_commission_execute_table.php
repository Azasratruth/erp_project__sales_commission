<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionExecuteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_execute', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('commission_id')->nullable();
            $table->foreign('commission_id')->references('id')->on('commission')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('added_by_id')->nullable();
            $table->foreign('added_by_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');


            $table->float('commission_amount')->nullable();

       
            $table->boolean('approved')->nullable();
       
            $table->unsignedBigInteger('approved_by_id')->nullable();
            $table->foreign('approved_by_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

       
            $table->boolean('executed')->nullable();

            $table->unsignedBigInteger('executed_by_id')->nullable();
            $table->foreign('executed_by_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commission_execute');
    }
}
