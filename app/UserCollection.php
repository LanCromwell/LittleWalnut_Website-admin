<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserCollection
 *
 * @property int $id
 * @property int $user_id 用户id
 * @property int $audio_id 音频id
 * @property int $add_time 添加时间
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCollection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCollection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCollection query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCollection whereAddTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCollection whereAudioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCollection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCollection whereUserId($value)
 * @mixin \Eloquent
 */
class UserCollection extends Model
{
    protected $table = 'user_collection';
    //
}
