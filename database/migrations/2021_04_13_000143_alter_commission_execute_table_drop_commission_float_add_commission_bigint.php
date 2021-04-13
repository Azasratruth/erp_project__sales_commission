<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCommissionExecuteTableDropCommissionFloatAddCommissionBigint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commission_execute', function ($table) {
            $table->dropColumn('commission_amount');
        });

        Schema::table('commission_execute', function ($table) {
            $table->unsignedBigInteger('commission_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commission_execute', function ($table) {
            $table->dropColumn('commission_amount');
        });
    }
}
