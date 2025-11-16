<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    protected string $tableName = 'members';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['administrator', 'boss', 'supervisor', 'employee'])->default('employee')->comment('員工角色');
            $table->string('code', 20)->unique()->comment('員工編號');
            $table->string('password')->comment('員工密碼');
            $table->string('name', 50)->comment('真實姓名');
            $table->string('english_name', 50)->comment('英文名稱');
            $table->rememberToken();
            $table->timestamps();
        });
        // table 備註
        DB::statement("ALTER" . " TABLE `" . $this->tableName . "` COMMENT '員工'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->tableName);
    }
};
