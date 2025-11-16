<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Member
 * @property int $id
 * @property string $role 員工角色
 * @property string $code 員工編號
 * @property string $password 密碼
 * @property string $name 真實姓名
 * @property string $english_name 英文名稱
 * @property null|string $remember_token Remember Token
 * @property string $created_at
 * @property string $updated_at
 */
class Member extends Authenticatable
{
    // 設定 table name
    protected $table = 'members';
    // 設定 table PK
    protected $primaryKey = 'id';
    // 設定 table 可異動 columns
    protected $fillable = [
//        'id',
        'role',
        'code',
        'password',
        'name',
        'english_name',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Laravel Relationships

    // Laravel Relationships 1:many feedback_expects
    public function expects()
    {
        return $this->hasMany(FeedbackExpect::class, 'member_id', 'id');
    }

    // 員工送出的點評
    // Laravel Relationships 1:many feedback_peer_reviews
    public function peerReviews()
    {
        return $this->hasMany(FeedbackPeerReview::class, 'member_id', 'id');
    }

    // 員工收到的點評
    // Laravel Relationships 1:many feedback_peer_reviews
    public function receivedPeerReviews()
    {
        return $this->hasMany(FeedbackPeerReview::class, 'target_member_id', 'id');
    }
}
