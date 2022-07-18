<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserInviteLog
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserInviteLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserInviteLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserInviteLog query()
 * @mixin \Eloquent
 */
class UserInviteLog extends Model
{
    protected $table = 'user_invite_log';

    public function userInviteList()
    {
        return $this->hasMany(User::class, 'be_invited_user_id', 'id');
    }
}
