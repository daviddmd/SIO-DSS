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
        Schema::create('invoice_lines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("invoice_id")->constrained()->cascadeOnDelete();
            $table->foreignId("product_id")->constrained()->cascadeOnDelete();
            $table->integer("quantity");
            $table->float("unitPrice");
            $table->float("taxPercentage");
            /*
             * Esta coluna inclui quaisqer descontos. Não inclui imposto.
             * Apenas um dos dois elementos CreditAmount ou DebitAmount está presente em cada linha.
             * Verificar quais dos dois difere de 0 e atribuir este valor a amount
             */
            $table->float("amount");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_lines');
    }
};
