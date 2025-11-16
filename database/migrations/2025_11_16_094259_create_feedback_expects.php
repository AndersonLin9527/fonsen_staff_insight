<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    protected string $tableName = 'feedback_expects';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            // 回饋 id
            $table->unsignedBigInteger('feedback_id')->index('index_feedback_id')->comment('回饋 id');
            $table->foreign('feedback_id', $this->tableName . '_1')
                ->references('id')->on('feedbacks')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            // 填答員工
            $table->unsignedBigInteger('member_id')->index('index_member_id')->comment('員工 id');
            $table->foreign('member_id', $this->tableName . '_2')
                ->references('id')->on('members')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            // 第一大題
            // 1-1 對公司/部門的期待
            $table->text('expect_company')->default('')->comment('1-1 對公司/部門的期待');
            // 1-2 你對未來重構計畫負責人(Anderson)有什麼期待
            $table->text('expect_leader')->default('')->comment('1-2 對領導者的期待');
            // 1-3 推舉的下一任計畫負責人(不關聯)
            $table->string('expect_next_leader', 100)->comment('1-3 推舉的下一任計畫負責人');
            // 1-3 為什麼
            $table->text('expect_next_leader_reason')->default('')->comment('1-3 推舉原因');

            $table->timestamps();

            // 一個活動中，一個員工只能有一份 feedback
            $table->unique(['feedback_id', 'member_id'], $this->tableName . '_composite_unique');
        });
        // table 備註
        DB::statement("ALTER" . " TABLE `" . $this->tableName . "` COMMENT '回饋期待'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->tableName);
    }
};
