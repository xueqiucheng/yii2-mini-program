<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/16
 * Time: 17:39
 */

namespace snowball\mini\qrcode;

use snowball\mini\core\Driver;
use Yii;
use yii\httpclient\Client;

class Qrcode extends Driver {

    //  获取不熟限制的小程序码
    const API_UN_LIMIT_CREATE = 'https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=';

    /**
     * 生成一个不限制的二维码
     * @param $scene
     * @param $page
     * @param array $extra
     * @return \yii\httpclient\Request;
     */
    public function unLimit($scene,$page,$extra = []){
        $params = array_merge(['scene'=>$scene,'page'=>$page],$extra);
        $response = $this->httpClient->createRequest()
            ->setUrl(Qrcode::API_UN_LIMIT_CREATE.$this->accessToken->getToken())
            ->setMethod('post')
            ->setFormat(Client::FORMAT_JSON)
            ->setData($params)->send();

        return $response->getContent();
    }
}