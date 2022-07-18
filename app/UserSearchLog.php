<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserSearchLog
 *
 * @property int $id
 * @property int $user_id 用户ID
 * @property string $content 搜索内容
 * @property int $add_time 添加时间
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSearchLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSearchLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSearchLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSearchLog whereAddTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSearchLog whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSearchLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSearchLog whereUserId($value)
 * @mixin \Eloquent
 */
class UserSearchLog extends Model
{
    protected $table = 'user_search_log';
    //
}
