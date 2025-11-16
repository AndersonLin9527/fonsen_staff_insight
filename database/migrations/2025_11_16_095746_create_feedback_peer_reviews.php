<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    protected string $tableName = 'feedback_peer_reviews';

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
            // 點評員工
            $table->unsignedBigInteger('target_member_id')->index('index_target_member_id')->comment('點評員工 id');
            $table->foreign('target_member_id', $this->tableName . '_3')
                ->references('id')->on('members')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            // 優點（你要求 3 個，但 DB 就當成一段文字，可用換行分點）
            $table->text('advantages')->default('')->comment('優點');
            // 缺點（同上）
            $table->text('weaknesses')->default('')->comment('缺點');
            $table->timestamps();

            $table->unique(['feedback_id', 'member_id', 'target_member_id'], $this->tableName . '_composite_unique');
        });
        // table 備註
        DB::statement("ALTER" . " TABLE `" . $this->tableName . "` COMMENT '回饋點評'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->tableName);
    }
};
