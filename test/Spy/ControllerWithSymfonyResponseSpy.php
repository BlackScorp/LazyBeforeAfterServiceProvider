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


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class ControllerWithSymfonyResponseSpy extends BaseControllerSpy{
    public function before(){
        $this->callBefore();
       // return new RedirectResponse('/');
    }
    public function beforeIndexAction(){
        $this->callBeforeAction();
        return new Response('');
    }
    public function afterIndexAction(){
        $this->callAfterAction();
        return new Response('');
    }
    public function after(){
        $this->callAfter();
        return new Response('');
    }
}