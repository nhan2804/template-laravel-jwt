<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_tickets', function (Blueprint $table) {
            $table->id('id_import_ticket');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->integer('from_storage_id')->nullable();
            $table->integer('to_storage_id')->nullable();
            $table->text('data')->nullable();
            $table->text('note');
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
        Schema::dropIfExists('import_tickets');
    }
}
