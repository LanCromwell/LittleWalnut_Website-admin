<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Channel
 *
 * @property int $id
 * @property string $name 名称
 * @property int $add_time 添加时间
 * @property string|null $channel_unique_code
 * @property int|null $download_num
 * @property int|null $register_num
 * @property int|null $access_num
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel whereAccessNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel whereAddTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel whereChannelUniqueCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel whereDownloadNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel whereRegisterNum($value)
 * @mixin \Eloquent
 */
class Channel extends Model
{
    protected $table = 'channel';

    public $timestamps = false;
    //
}
