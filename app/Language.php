<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Language
 *
 * @property int $id
 * @property string $name 语言名称
 * @property int $add_time 添加时间
 * @property int|null $is_hide
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Language query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Language whereAddTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Language whereIsHide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Language whereName($value)
 * @mixin \Eloquent
 */
class Language extends Model
{
    protected $table = 'language';
    //
}
