<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class FeedbackPeerReview
 * @property int $id
 * @property int $feedback_id 回饋 id
 * @property int $member_id 填寫員工 id
 * @property int $target_member_id 點評員工 id
 * @property string $advantages 優點
 * @property string $weaknesses 缺點
 * @property string $created_at
 * @property string $updated_at
 */
class FeedbackPeerReview extends Model
{
    use HasFactory;

    // 設定 table name
    protected $table = 'feedback_peer_reviews';
    // 設定 table PK
    protected $primaryKey = 'id';
    // 設定 table 可異動 columns
    protected $fillable = [
//        'id',
        'feedback_id',
        'member_id',
        'target_member_id',
        'advantages',
        'weaknesses',
        'created_at',
        'updated_at',
    ];

}
