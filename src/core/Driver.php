<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/16
 * Time: 20:56
 */

namespace abei2017\mini\core;

use abei2017\mini\core\AccessToken;

abstract class Driver {

    public $httpClient;
    public $accessToken;
    public $conf;
    public $extra;

    /**
     * @return mixed
     */
    public function getAccessToken() {
        return $this->accessToken;
    }


}