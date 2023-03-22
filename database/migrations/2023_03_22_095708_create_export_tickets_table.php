<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_tickets', function (Blueprint $table) {
            $table->id('id_export_ticket');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->integer('from_storage_id')->nullable();
            $table->integer('to_storage_id')->nullable();
            $table->text('note')->nullable();
            $table->text('data')->nullable();
            $table->string('status')->default("PENDING");
            $table->integer('user_id');

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
        Schema::dropIfExists('export_tickets');
    }
}
