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


class ControllerWithAfterOnlySpy extends BaseControllerSpy{
    public function after(){
        $this->callAfter();
    }
}