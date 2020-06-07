<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('whatsapp_number', 20);
            $table->string('webVersion', 120);
            $table->string('pushname', 120);
            $table->string('server', 120);
            $table->string('user', 120);
            $table->string('_serialized', 120);
            $table->string('wa_version', 120);
            $table->string('os_version', 120);
            $table->string('device_manufacturer', 120);
            $table->string('device_model', 120);
            $table->string('os_build_number', 120);
            $table->string('platform', 120);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('services');
    }
}
