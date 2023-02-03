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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->foreignId('plan_id')->nullable()->constrained('plans')->nullOnDelete();
            $table->integer('days')->default(0);
            $table->integer('status')->default(0);
            //0=درحال برسی و 1=در انتضار پرداخت و  و2=درحال انجام و 3=درانتضار پرداخت نهایی و 4=اتمام و 5=لغو و
            // 1- = لغو
            // 0 = درحال برسی
            // 1 = دریافت اطلاعات و پرداخت اولیه
            // 2 = بررسی اطلاعات
            // 3 = درحال انجام
            // 4 = ارسال دمو پروژه
            // 5 = تحویل پروژه
            $table->string('description',5000);
            $table->string('file')->nullable();
            $table->integer('fee')->default(0);
            $table->timestamp('finished_at')->nullable();
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
        Schema::dropIfExists('projects');
    }
};
