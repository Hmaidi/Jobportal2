<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title');

            $table->longText('description');

            $table->longText('requirements');
            
            $table->date('expiry_date');

            $table->string('salary');

            $table->string('internal_reference');

            $table->string('experience');

            $table->string('status')->default('draft');

            $table->timestamps();
            
            $table->unsignedBigInteger('location_id')->nullable();

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');

            $table->unsignedBigInteger('company_id')->nullable();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->unsignedBigInteger('contract_id')->nullable();

            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job');
    }
}
