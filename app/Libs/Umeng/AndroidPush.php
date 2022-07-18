<?php
namespace App\Libs\Umeng;

use App\Libs\Umeng\src\notification\android\AndroidBroadcast;

//require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidFilecast.php');
//require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidGroupcast.php');
//require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidUnicast.php');
//require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidCustomizedcast.php');

class AndroidPush {
	protected $appkey           = NULL; 
	protected $appMasterSecret     = NULL;
	protected $timestamp        = NULL;
	protected $validation_token = NULL;

	function sendAndroidBroadcast($data = []) {
		if (!$data) {
			throw new Exception('数据为空');
		}
		try {
			$brocast = new AndroidBroadcast();
			$brocast->setAppMasterSecret($this->appMasterSecret);
			$brocast->setPredefinedKeyValue("appkey",           $this->appkey);
			$brocast->setPredefinedKeyValue("timestamp",        $this->timestamp);
			$brocast->setPredefinedKeyValue("ticker",           "Android broadcast ticker");
			$brocast->setPredefinedKeyValue("title",            "中文的title");
			$brocast->setPredefinedKeyValue("text",             "Android broadcast text");
			$brocast->setPredefinedKeyValue("after_open",       "go_app");
			// Set 'production_mode' to 'false' if it's a test device. 
			// For how to register a test device, please see the developer doc.
			$brocast->setPredefinedKeyValue("production_mode", "true");
			// [optional]Set extra fields
			$brocast->setExtraField("test", "helloworld");
			print("Sending broadcast notification, please wait...\r\n");
			$brocast->send();
			print("Sent SUCCESS\r\n");
		} catch (Exception $e) {
			print("Caught exception: " . $e->getMessage());
		}
	}
}

// Set your appkey and master secret here
$demo = new Demo("your appkey", "your app master secret");
$demo->sendAndroidUnicast();
/* these methods are all available, just fill in some fields and do the test
 * $demo->sendAndroidBroadcast();
 * $demo->sendAndroidFilecast();
 * $demo->sendAndroidGroupcast();
 * $demo->sendAndroidCustomizedcast();
 * $demo->sendAndroidCustomizedcastFileId();
 *
 * $demo->sendIOSBroadcast();
 * $demo->sendIOSUnicast();
 * $demo->sendIOSFilecast();
 * $demo->sendIOSGroupcast();
 * $demo->sendIOSCustomizedcast();
 */