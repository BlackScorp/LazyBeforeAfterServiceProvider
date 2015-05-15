<?php
/*
 * This file is part of LazyBeforeAfterServiceProvier.
 *
 * (c) Vitalij Mik <vitalij@blackscorp.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BlackScorp\Silex\Test\Spy;


class ControllerWithBeforeActionOnlySpy extends BaseControllerSpy{
    public function beforeIndexAction(){
        $this->callBeforeAction();
    }

}