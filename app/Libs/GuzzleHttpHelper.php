<?php
namespace App\Libs;

class GuzzleHttpHelper
{

	public static function post($baseUrl = '', $body = [],$apiStr = '')
	{
//		var_dump($body);die;
		$client = new \GuzzleHttp\Client(['base_uri' => $baseUrl]);
		$res = $client->request('POST', $apiStr,
			$body
		);

		dd($res);
		$data = $res->getBody()->getContents();

		return $data;
	}

	public static function get($baseUrl,$apiStr = '',$header=[])
	{
		$client = new \GuzzleHttp\Client(['base_uri' => $baseUrl]);
		$res = $client->request('GET', $apiStr,['headers' => $header]);
		$statusCode= $res->getStatusCode();

		$header= $res->getHeader('content-type');

		$data = $res->getBody();

		return $data;
	}
}
