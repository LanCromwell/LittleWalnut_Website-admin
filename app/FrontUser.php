<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FrontUser
 *
 * @property int $id
 * @property string $name 用户名
 * @property string $icon 头像
 * @property int $phone 手机号
 * @property string $password 密码
 * @property string $invitation_code 邀请码
 * @property int $child_birthday 孩子生日
 * @property string $province 省份
 * @property string $city 城市
 * @property string $county 县
 * @property string $detailed_location 详细位置
 * @property string $operator 运营商
 * @property string|null $phone_model 手机型号
 * @property int $role_id 角色Id
 * @property int $language_id 语言Id
 * @property int $add_time 添加时间
 * @property string|null $third_icon 三方头像
 * @property string|null $third_name 三方名称
 * @property string|null $third_unique_id 三方唯一标识
 * @property int|null $is_del
 * @property int|null $type 0-手机密码   1-微信   2-qq
 * @property int $update_time 添加时间
 * @property int|null $channel_id
 * @property int|null $is_receive_vip
 * @property string|null $phone_brand 手机型号
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserListenToAudioLog[] $UserListenAudioLogs
 * @property-read int|null $user_listen_audio_logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserSearchLog[] $UserSearchLogs
 * @property-read int|null $user_search_logs_count
 * @property-read \App\Language $language
 * @property-read \App\Role $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserCollection[] $userCollections
 * @property-read int|null $user_collections_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereAddTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereChildBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereCounty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereDetailedLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereInvitationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereIsDel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereIsReceiveVip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereOperator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser wherePhoneBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser wherePhoneModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereThirdIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereThirdName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereThirdUniqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FrontUser whereUpdateTime($value)
 * @mixin \Eloquent
 */
class FrontUser extends Model
{
    protected $table = 'users';
    public $timestamps = false;


    public function language()
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }

    public function roles()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function UserSearchLogs()
    {
        return $this->hasMany(UserSearchLog::class, 'user_id', 'id');
    }

    public function UserListenAudioLogs()
    {
        return $this->hasMany(UserListenToAudioLog::class, 'user_id', 'id');
    }

    public function userCollections()
    {
        return $this->hasMany(UserCollection::class, 'user_id', 'id');
    }

    public function userInviteList()
    {
        return $this->hasMany(UserInviteLog::class, 'invited_user_id', 'id');
    }

}
