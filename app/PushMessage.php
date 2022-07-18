<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PushMessage
 *
 * @property int $id
 * @property string $title 标题
 * @property string $content 内容
 * @property string $push_time 推送时间
 * @property int $add_time 添加时间
 * @property int $update_time 更新时间
 * @property int|null $type 0-每日推送   1-立即推送
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushMessage whereAddTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushMessage whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushMessage wherePushTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushMessage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushMessage whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PushMessage whereUpdateTime($value)
 * @mixin \Eloquent
 */
class PushMessage extends Model
{
    protected $table = 'push_message';

    protected $guarded = [];

    public $timestamps = false;
    //
}
