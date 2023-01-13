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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('pay_num')->nullable();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->integer('amount');
            $table->string('info');
            $table->integer('status')->default(0);
            //0=در انتضار پرداخت و 1=پرداخت شده و 2=خطا یا پرداخت نشده.
            $table->timestamp('pay_date')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
