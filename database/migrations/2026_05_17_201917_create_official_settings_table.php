<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    protected $connection = null;
    private string $table = 'official_settings';

    /**
     * 执行迁移
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable($this->table)) {
            //创建表
            Schema::create($this->table, function (Blueprint $table) {
                $table->comment('官网设置表');
                $table->increments('id');
                $table->string('key', 64)->nullable()->index()->comment('标识名');
                $table->text('values')->nullable()->comment('对象值');
                $table->string('module', 32)->nullable()->index()->comment('模块');
                $table->integer('mer_id')->nullable()->index()->comment('商户');
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->nullable()->useCurrent();
                //$table->timestamps();
            });
        }
    }

    /**
     * 迁移回滚
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable($this->table)) {
            // 检查是否存在数据
            $exists = DB::table($this->table)->exists();
            // 不存在数据时，删除表
            if (! $exists) {
                // 删除 reverse
                Schema::dropIfExists($this->table);
            }
        }
    }
};
