<?php
/*
 * This file is part of the abei2017/yii2-mini-program.
 *
 * (c) abei <abei@nai8.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace abei2017\mini;

use Yii;
use yii\base\Component;
use yii\httpclient\Client;
use abei2017\mini\core\AccessToken;
use abei2017\mini\pay\Pay;
use abei2017\mini\qrcode\Qrcode;
use abei2017\mini\tmpl\Tmpl;

/**
 * The bootstrap.
 *
 * @package abei2017\mini
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