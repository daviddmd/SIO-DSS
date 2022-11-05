<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("company_id")->constrained()->cascadeOnDelete();
            $table->foreignId("customer_id")->constrained()->cascadeOnDelete();
            $table->string("invoice_number");
            $table->date("invoice_date");
            $table->string("shipping_city");
            $table->string("shipping_country");
            $table->enum("invoice_type", ["FT", "FS", "FR", "ND", "NC"])->default("FT");
            /*
             * Este sistema é "read-only", logo faz sentido estes valores serem pré-calculados
             * (ou retirados do SAF-T), em vez de serem sempre calculados na query, o que causaria
             * problemas de desempenho
             */
            $table->float("taxPayable");
            $table->float("netTotal");
            $table->float("grossTotal");
            //na hora de query total por mês, fazer sum group by where invoice type != NC - sum invoice type = NC
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
