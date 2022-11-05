<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("company_id")->constrained()->cascadeOnDelete();
            $table->string("code"); //normalizar
            $table->string("family")->nullable(); //normalizars
            $table->enum("type",array("P","S","O","E","I"))->default("P");
            $table->string("description"); //Normalizar para não ser tudo maiúsculo
            $table->string("number_code");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
