<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @property int $id
 * @property string $name 分类名称
 * @property string $img 分类图片
 * @property int $pid 分类父级ID
 * @property int $add_time 添加时间
 * @property int $update_time 更新时间
 * @property int $audio_numebr 音频数量
 * @property int $click_number 点击数量
 * @property int $is_del 是否删除
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereAddTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereAudioNumebr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereClickNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereIsDel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category wherePid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereUpdateTime($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    protected $table = 'category';

    protected $guarded = [];

    public $timestamps = false;


    //
}
