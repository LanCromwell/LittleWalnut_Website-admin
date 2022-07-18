<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserListenToAudioLog
 *
 * @property int $id
 * @property int $user_id 用户id
 * @property int $audio_id 音频id
 * @property int $add_time 添加时间
 * @property int|null $number 重复个数
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserListenToAudioLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserListenToAudioLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserListenToAudioLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserListenToAudioLog whereAddTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserListenToAudioLog whereAudioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserListenToAudioLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserListenToAudioLog whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserListenToAudioLog whereUserId($value)
 * @mixin \Eloquent
 */
class UserListenToAudioLog extends Model
{
    protected $table = 'user_listen_to_audio_log';
    //
}
