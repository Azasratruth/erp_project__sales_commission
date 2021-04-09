<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSalesPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_sales_plan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('added_by_id')->nullable();
            $table->foreign('added_by_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedTinyInteger('quarter')->nullable();
            
       
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
        Schema::dropIfExists('employee_sales_plan');
    }
}
