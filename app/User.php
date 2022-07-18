<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
/**
 * App\User
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
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAddTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereChildBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCounty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDetailedLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereInvitationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsDel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsReceiveVip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereOperator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhoneBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhoneModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereThirdIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereThirdName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereThirdUniqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdateTime($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
