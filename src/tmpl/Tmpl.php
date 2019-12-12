<?php
/*
 * This file is part of the snowball/yii2-mini-program.
 *
 * (c) abei <abei@nai8.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace snowball\mini\tmpl;

use snowball\mini\core\Driver;
use Yii;
use yii\httpclient\Client;

/**
 * Class Tmpl.
 *
 * @package snowball\mini\tmpl
 */
class Tmpl extends Driver {
    const API_SEND_TMPL = 'https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token=';

    /**
     * 发送模板消息
     *
     * @param $toUser
     * @param $templateId
     * @param $formId
     * @param $data
     * @param array $extra
     */
    public function send($toUser,$templateId,$formId,$data,$extra = []){
        $params = array_merge([
            'touser'=>$toUser,
            'template_id'=>$templateId,
            'form_id'=>$formId,
            'data'=>$data,
        ],$extra);

        $response = $this->httpClient->createRequest()
            ->setUrl(Tmpl::API_SEND_TMPL.$this->accessToken->getToken())
            ->setMethod('post')
            ->setFormat(Client::FORMAT_JSON)
            ->setData($params)->send();

        return $response->getContent();
    }
}