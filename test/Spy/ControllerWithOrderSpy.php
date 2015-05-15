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


class ControllerWithOrderSpy extends BaseControllerSpy{
    private $orderIndicator = array();
    public function getOrderIndicator(){
        return implode('|',$this->orderIndicator);
    }
    public function before(){
        $this->callBefore();
        $this->orderIndicator[]=__FUNCTION__;
    }
    public function beforeIndexAction(){
        $this->callBeforeAction();
        $this->orderIndicator[]=__FUNCTION__;
    }
    public function indexAction(){
        $this->callAction();
        $this->orderIndicator[]=__FUNCTION__;
    }
    public function afterIndexAction(){
        $this->callAfterAction();
        $this->orderIndicator[]=__FUNCTION__;
    }
    public function after(){
        $this->callAfter();
        $this->orderIndicator[]=__FUNCTION__;
    }
}