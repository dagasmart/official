<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = null;

    private string $table = 'official_menu';

    /**
     * 执行迁移
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable($this->table)) {
            // 创建表
            Schema::create($this->table, function (Blueprint $table) {
                $table->comment('官网菜单表');
                $table->id();
                $table->integer('parent_id')->default(0)->index()->comment('父级ID');
                $table->tinyInteger('custom_order')->default(10)->comment('排序[0-255]');
                $table->string('title', 32)->nullable()->comment('菜单名称');
                $table->string('icon', 100)->nullable()->comment('菜单图标');
                $table->tinyInteger('url_type')->default(1)->comment('导航类型(1:路由,2:外链,3:iframe)');
                $table->string('url', 255)->nullable()->comment('访问url');
                $table->tinyInteger('visible')->default(1)->comment('是否可见');
                $table->string('is_home')->default(0)->comment('是否首页');
                $table->tinyInteger('keep_alive')->nullable()->comment('页面缓存');
                $table->string('component', 255)->nullable()->comment('菜单组件');
                $table->string('is_full')->nullable()->comment('是否页面');
                $table->string('module', 32)->nullable()->index()->comment('模块');
                $table->integer('mer_id')->nullable()->index()->comment('商户');
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->nullable()->useCurrent();
                // $table->timestamps();
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
