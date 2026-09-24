<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'master';

    private string $name = 'mcs_official_contact';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        ! Schema::hasTable($this->name)
        && Schema::create($this->name, function (Blueprint $table) {
            $table->comment('通用-官网-联系表');
            $table->id();
            $table->string('name')->comment('姓名');
            $table->string('email')->comment('邮箱');
            $table->string('phone')->nullable()->comment('手机号');
            $table->string('company')->nullable()->comment('公司');
            $table->string('service')->nullable()->comment('服务类别');
            $table->text('message')->comment('留言');
            $table->string('locale', 5)->default('zh')->comment('lang');
            $table->string('ip_address', 45)->nullable()->comment('ip');
            $table->string('user_agent')->nullable()->comment('访问来源');
            $table->boolean('is_read')->default(false)->comment('已读');
            $table->string('module', 32)->nullable();
            $table->integer('mer_id')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            //$table->timestamps();
        });

        $driver = config('database.connections.'.$this->connection.'.driver');
        if ($driver == 'mysql') {
            DB::statement("ALTER TABLE {$this->name} AUTO_INCREMENT=10000000");
        }
        if ($driver == 'pgsql') {
            DB::statement("alter sequence {$this->name}_id_seq restart with 10000000");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable($this->name)) {
            // 检查是否存在数据
            $exists = DB::table($this->name)->exists();
            // 不存在数据时，删除表
            if (! $exists) {
                // 删除 reverse
                Schema::dropIfExists($this->name);
            }
        }
    }
};
