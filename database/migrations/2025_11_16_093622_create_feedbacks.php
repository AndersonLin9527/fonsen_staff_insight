<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    protected string $tableName = 'feedbacks';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique()->comment('回饋代號');
            $table->string('title', 100)->comment('回饋主題');
            $table->text('memo')->default('')->comment('回饋備註');
            $table->timestamp('start_at')->comment('開始於');
            $table->timestamp('close_at')->comment('結束於');
            $table->tinyInteger('status')->comment('狀態');
            $table->timestamps();
        });
        // table 備註
        DB::statement("ALTER" . " TABLE `" . $this->tableName . "` COMMENT '回饋'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->tableName);
    }
};
