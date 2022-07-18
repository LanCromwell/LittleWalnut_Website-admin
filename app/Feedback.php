<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Feedback
 *
 * @property int $id
 * @property int $user_id 用户id
 * @property string $content 反馈内容
 * @property int $add_time 添加时间
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Feedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Feedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Feedback query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Feedback whereAddTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Feedback whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Feedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Feedback whereUserId($value)
 * @mixin \Eloquent
 */
class Feedback extends Model
{
    protected $table = 'feedback';
    //
}
