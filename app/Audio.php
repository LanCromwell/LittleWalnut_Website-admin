<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Audio
 *
 * @property int $id
 * @property string $title 标题
 * @property string $duration 时长
 * @property int $play_number 播放量
 * @property int $collect_number 收藏量
 * @property int $language_id 语言id
 * @property int $category_id 分类id
 * @property int $add_time 添加时间
 * @property string|null $audio_path 音频路径
 * @property int|null $type 0-每日2分钟提醒1-五分钟小专题
 * @property int|null $remind_date
 * @property string|null $search_content
 * @property int $sort
 * @property-read \App\Category $category
 * @property-read \App\Language $language
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Audio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Audio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Audio query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Audio whereAddTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Audio whereAudioPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Audio whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Audio whereCollectNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Audio whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Audio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Audio whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Audio wherePlayNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Audio whereRemindDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Audio whereSearchContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Audio whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Audio whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Audio whereType($value)
 * @mixin \Eloquent
 */
class Audio extends Model
{
    protected $table = 'audio';

    protected $guarded = [];

    public $timestamps = false;

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function language()
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }
    //
}
