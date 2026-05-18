<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('public')->create('official_settings', function (Blueprint $table) {
            $table->comment('智慧官网-设置表');
            $table->increments('id');
            $table->string('key', 64)->nullable()->index()->comment('标识名');
            $table->text('values')->nullable()->comment('对象值');
            $table->string('module', 32)->nullable()->index()->comment('模块');
            $table->integer('mer_id')->nullable()->index()->comment('商户');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('school')->dropIfExists('biz_access_user');
    }
};
