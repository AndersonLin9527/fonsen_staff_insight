<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Feedback
 * @property int $id
 * @property string $code 回饋代號
 * @property string $title 回饋主題
 * @property string $memo 回饋備註
 * @property string $start_at 開始於
 * @property string $close_at 結束於
 * @property int $status 狀態
 * @property string $created_at
 * @property string $updated_at
 */
class Feedback extends Model
{
    use HasFactory;

    // 設定 table name
    protected $table = 'feedbacks';
    // 設定 table PK
    protected $primaryKey = 'id';
    // 設定 table 可異動 columns
    protected $fillable = [
//        'id',
        'code',
        'title',
        'memo',
        'start_at',
        'close_at',
        'status',
        'created_at',
        'updated_at',
    ];
}
