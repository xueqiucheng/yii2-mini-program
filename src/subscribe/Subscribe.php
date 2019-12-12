<?php
/*
 * This file is part of the abei2017/yii2-mini-program.
 *
 * (c) abei <abei@nai8.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace abei2017\mini\subscribe;

use abei2017\mini\core\Driver;
use Yii;
use yii\httpclient\Client;

/**
 * Class Tmpl.
 *
 * @package abei2017\mini\tmpl
 */
class Subscribe extends Driver {
    const API_SEND_SUBSCRIBE = 'https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=';

    /**
     * 发送订阅消息
     *
     * @param $toUser
     * @param $templateId
     * @param $data
     * @param array $extra
     */
    public function send($toUser,$templateId,$data,$extra = []){
        $params = array_merge([
            'access_token'=>$this->accessToken->getToken(),
            'touser'=>$toUser,
            'template_id'=>$templateId,
            'data'=>$data,
        ],$extra);

        $response = $this->httpClient->createRequest()
            ->setUrl(Subscribe::API_SEND_SUBSCRIBE.$this->accessToken->getToken())
            ->setMethod('post')
            ->setFormat(Client::FORMAT_JSON)
            ->setData($params)->send();

        return $response->getContent();
    }
}