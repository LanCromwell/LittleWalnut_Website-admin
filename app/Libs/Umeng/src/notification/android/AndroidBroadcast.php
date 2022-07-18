<?php
namespace App\Libs\Umeng\src\notification\android;

use App\Libs\Umeng\src\notification\AndroidNotification;

class AndroidBroadcast extends AndroidNotification {
	function  __construct() {
		parent::__construct();
		$this->data["type"] = "broadcast";
	}
}