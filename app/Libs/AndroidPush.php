<?php /** @noinspection PhpInconsistentReturnPointsInspection */

namespace App\Libs;

use App\Libs\Umeng\src\notification\android\AndroidBroadcast;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Element;
use PhpParser\Node\Expr\Array_;

//require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidFilecast.php');
//require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidGroupcast.php');
//require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidUnicast.php');
//require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidCustomizedcast.php');

class AndroidPush {
	// The host
	protected $host = "http://msg.umeng.com";
	// The upload path
	protected $uploadPath = "/upload";
	// The post path
	protected $postPath = "/api/send";
	protected $appkey           = NULL;
	protected $appMasterSecret     = NULL;
	protected $timestamp        = NULL;
	protected $validationToken = NULL;
	protected $body = [];
	protected $policy = [];
	protected $sendData = [];
	protected $boyKey    = ["ticker", "title", "text", "builder_id", "icon", "largeIcon", "img", "play_vibrate", "play_lights", "play_sound", "after_open", "url", "activity", "custom"];


	public function __construct()
	{
		$this->appkey = env('UMENG_APPKEY', '5c2d7732b465f529e200005a');
		$this->appMasterSecret = env('UMENG_APP_MASTER_SECRET', 'ptegn3547lcbyry8dofqscxpibdj2rgs');
		$this->timestamp = time();
	}

	public function _setSendData()
	{
		$this->sendData = [
			'appkey' => $this->appkey,
			'timestamp' => $this->timestamp,
			'type' => 'broadcast',
			'payload' => [
				'display_type' => 'notification',
				'body' => $this->body,
			],
			'production_mode' => "true", // 测试模式
			'mipush' => "true", // 可选，默认为false。当为true时，表示MIUI、EMUI、Flyme系统设备离线转为系统下发
			'mi_activity' => "cn.baby.love.activity.WelcomeActivity", // 可选，mipush值为true时生效，表示走系统通道时打开指定页面acitivity的完整包路径。
		];
	}

	/**
	 * @param string $aliasName
	 * @param array $body
	 * @return bool|string
	 * @throws \Exception
	 */
	public function sendCustomizedcastData(string $aliasName, array $body)
	{
		if (empty($aliasName) && empty($body)) {
			return false;
		}
		$sendData = [
			'appkey' => $this->appkey,
			'timestamp' => $this->timestamp,
			'type' => 'customizedcast',
			'alias_type' => 'xht_app',
			'alias' => $aliasName,
			'payload' => [
				'display_type' => 'notification',
				'body' => $body,
			],
			'production_mode' => "false", // 测试模式
			'mipush' => "true", // 可选，默认为false。当为true时，表示MIUI、EMUI、Flyme系统设备离线转为系统下发
			'mi_activity' => "cn.baby.love.activity.WelcomeActivity", // 可选，mipush值为true时生效，表示走系统通道时打开指定页面acitivity的完整包路径。
		];
		$url = $this->host . $this->postPath;
		Log::info($sendData);
		$postBody = json_encode($sendData);
		$sign = md5("POST" . $url . $postBody . $this->appMasterSecret);
		$apiStr = "?sign=" . $sign;
		try {
			$a = $this->_send($url . $apiStr, $postBody);
		} catch (\Exception $e) {
			Log::info($e->getMessage());
			throw new \Exception('参数不合法');
		}
		return($a);
	}


	/**
	 * @param array $data
	 * @param array $policy
	 * @return mixed
	 * @throws \Exception
	 */
	function sendAndroidBroadcast($data = [], $policy = [])
	{
		if (!$data) {
			throw new \Exception('数据为空');
		}
		foreach ($data as $k => $v) {
			if (in_array($k, $this->boyKey)) {
				$this->body[$k] = $v;
			}
		}
		$this->_setSendData();
		if ($policy) {
			$this->sendData['policy'] = $policy;
		}
		$url = $this->host . $this->postPath;
		$postBody = json_encode($this->sendData);
		$sign = md5("POST" . $url . $postBody . $this->appMasterSecret);
		$apiStr = "?sign=" . $sign;
		$a = $this->_send($url.$apiStr, $postBody);
		return($a);
	}

	private function _send($url, $postBody) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postBody );
		$result = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curlErrNo = curl_errno($ch);
		$curlErr = curl_error($ch);
		curl_close($ch);
//		print($result . "\r\n");
		if ($httpCode == "0") {
			// Time out
			throw new \Exception("Curl error number:" . $curlErrNo . " , Curl error details:" . $curlErr . "\r\n");
		} else if ($httpCode != "200") {
			// We did send the notifition out and got a non-200 response
			throw new \Exception("Http code:" . $httpCode .  " details:" . $result . "\r\n");
		} else {
			return $result;
		}
	}


}
