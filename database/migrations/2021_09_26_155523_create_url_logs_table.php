<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('url_id');
            $table->char('status_code', 4);
            $table->binary('data');
            $table->timestamps();

            $table->foreign('url_id')->references('id')
            ->on('urls')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

        DB::statement("ALTER TABLE url_logs MODIFY COLUMN data LONGBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url_logs');
    }
}
