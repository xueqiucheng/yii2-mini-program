<?php
/*
 * This file is part of the snowball/yii2-mini-program.
 *
 * (c) abei <abei@nai8.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace snowball\mini\pay;

/**
 * Class PayException
 * @package snowball\mini\pay
 * @author abei<abei@nai8.me>
 * @link http://nai8.me
 * @version 1.0
 */

class PayException extends \yii\base\Exception {

    public function getName(){
        return 'Mini Program Exception';
    }


}