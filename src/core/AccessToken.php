<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/16
 * Time: 17:53
 */

namespace snowball\mini\core;

use Yii;
use yii\httpclient;

class AccessToken {

    protected $appId;

    protected $secret;

    const API_TOKEN_GET = 'https://api.weixin.qq.com/cgi-bin/token';

    protected $cacheKey = 'yii2-mini-program-access-token';

    /**
     * 获得token
     * @param array $conf
     */
    public function __construct($conf = []){
        $this->appId = $conf['appId'];
        $this->secret = $conf['secret'];
    }

    public function getToken(){
        $data = Yii::$app->cache->get($this->cacheKey);
        if ($data === false) {
            $token = $this->getTokenFromServer();
            Yii::$app->cache->set($this->cacheKey, $token['access_token'], $token['expires_in'] - 1500);
        }

        return $data;
    }

    /**
     * 从微信服务器获取access token。
     */
    public function getTokenFromServer(){
        $params = [
            'appid' => $this->appId,
            'secret' => $this->secret,
            'grant_type' => 'client_credential',
        ];

        $client = new httpclient\Client([
            'transport' => 'yii\httpclient\CurlTransport'
        ]);

        $response = $client->createRequest()
            ->setUrl(self::API_TOKEN_GET)
            ->setMethod('get')
            ->setData($params)->send();

        return $response->getData();

    }
}