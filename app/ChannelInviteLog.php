<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ChannelInviteLog extends Model
{
	use Notifiable;

	protected $table = 'channel_invite_log';

	public $timestamps = false;

}
