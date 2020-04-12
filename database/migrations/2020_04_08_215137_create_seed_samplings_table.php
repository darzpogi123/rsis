<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeedSamplingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_samplings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('request_no')->nullable()->default(null);
            $table->string('lab_no')->nullable()->default(null);
            $table->string('crop')->nullable()->default(null);
            $table->string('variety')->nullable()->default(null);
            $table->string('source')->nullable()->default(null);
            $table->string('lot_no', 10)->nullable()->default(null);
            $table->string('weight_of_seed_lot')->nullable()->default(null);
            $table->string('no_of_bags',10);
            $table->string('date_harvested')->nullable()->default(null);
            $table->string('container')->nullable()->default(null);
            $table->string('date_of_application')->nullable()->default(null);;
            $table->string('moisture_content')->nullable()->default(null);
            $table->string('physical_purity')->nullable()->default(null);
            $table->string('germination')->nullable()->default(null);
            $table->string('varietal_purity')->nullable()->default(null);
            $table->string('seed_health')->nullable()->default(null);
            $table->string('ttc')->nullable()->default(null);
            $table->string('others')->nullable()->default(null);
            $table->string('fname')->nullable()->default(null);
            $table->string('mname')->nullable()->default(null);
            $table->string('lname')->nullable()->default(null);
            $table->string('ename')->nullable()->default(null);
            $table->string('name_of_company')->nullable()->default(null);
            $table->string('address')->nullable()->default(null);
            $table->string('purpose')->nullable()->default(null);
            $table->string('remarks')->nullable()->default(null);
            $table->integer('status')->nullable()->default(1)->comment("1=active;0=inactive");
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
        Schema::dropIfExists('seed_samplings');
    }
}
