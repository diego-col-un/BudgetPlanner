<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {


        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 15, 2);
            $table->enum('transaction_type', ['income', 'expense']);
            $table->text('description')->nullable();
            $table->date('transaction_date');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}