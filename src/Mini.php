<?php
/*
 * This file is part of the snowball/yii2-mini-program.
 *
 * (c) abei <abei@nai8.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace snowball\mini;

use Yii;
use yii\base\Component;
use yii\httpclient\Client;
use snowball\mini\core\AccessToken;
use snowball\mini\pay\Pay;
use snowball\mini\qrcode\Qrcode;
use snowball\mini\tmpl\Tmpl;

/**
 * The bootstrap.
 *
 * @package snowball\mini
 */
class Mini extends Component {

    public $conf = [];

    protected $accessToken;
    protected $httpClient;

    public $classMaps = [
        'qrcode'=>Qrcode::class,
        'pay'=>Pay::class,
        'tmpl'=>Tmpl::class,
    ];

    public function init() {
        $this->accessToken = new AccessToken(['appId'=>$this->conf['appId'],'secret'=>$this->conf['secret']]);
        $this->httpClient = new Client([
            'transport' => 'yii\httpclient\CurlTransport'
        ]);
    }

    /**
     * 调用某个小程序接口并传递参数
     * @param $api
     * @param array $extra
     * @return object
     */
    public function driver($api,$extra = []){
        $config = [
            'conf'=>$this->conf,
            'extra'=>$extra,
            'accessToken'=>$this->accessToken,
            'httpClient'=>$this->httpClient,
        ];
        $Class = $this->classMaps[$api];
        $config['class'] = $Class;

        return Yii::createObject($config);
    }
}