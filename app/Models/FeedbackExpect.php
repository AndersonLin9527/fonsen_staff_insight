<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class FeedbackExpect
 * @property int $id
 * @property int $feedback_id 回饋 id
 * @property int $member_id 員工 id
 * @property string $expect_company 1-1 對公司/部門的期待
 * @property string $expect_leader 1-2 對領導者的期待
 * @property string $expect_next_leader 1-3 推舉下一任領導者
 * @property string $expect_next_leader_reason 1-3 推舉原因
 * @property string $created_at
 * @property string $updated_at
 */
class FeedbackExpect extends Model
{
    use HasFactory;

    // 設定 table name
    protected $table = 'feedback_expects';
    // 設定 table PK
    protected $primaryKey = 'id';
    // 設定 table 可異動 columns
    protected $fillable = [
//        'id',
        'feedback_id',
        'member_id',
        'expect_company',
        'expect_leader',
        'expect_next_leader',
        'expect_next_leader_reason',
        'created_at',
        'updated_at',
    ];
}
