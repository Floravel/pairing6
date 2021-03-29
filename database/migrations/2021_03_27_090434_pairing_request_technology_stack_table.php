<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PairingRequestTechnologyStackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pairing_request_technology_stack', function (Blueprint $table) {
            $table->integer('pairing_request_id')->unsigned();
            $table->integer('technology_stack_id')->unsigned();

            $table->foreign('pairing_request_id')->references('id')->on('pairing_requests')
                ->onDelete('cascade');
            $table->foreign('technology_stack_id')->references('id')->on('technology_stacks')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
