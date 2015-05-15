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


class BaseControllerSpy
{
    private $beforeCalled = false;
    private $beforeActionCalled = false;
    private $actionCalled = false;
    private $afterActionCalled = false;
    private $afterCalled = false;

    protected function callBefore()
    {
        $this->beforeCalled = true;
    }

    protected function callBeforeAction()
    {
        $this->beforeActionCalled = true;
    }

    protected function callAction()
    {
        $this->actionCalled = true;
    }

    protected function callAfterAction()
    {
        $this->afterActionCalled = true;
    }

    protected function callAfter()
    {
        $this->afterCalled = true;
    }

    public function beforeCalled()
    {
        return $this->beforeCalled;
    }

    public function beforeActionCalled()
    {
        return $this->beforeActionCalled;
    }

    public function actionCalled()
    {
        return $this->actionCalled;
    }

    public function afterActionCalled()
    {
        return $this->afterActionCalled;
    }

    public function afterCalled()
    {
        return $this->afterCalled;
    }
    public function indexAction(){
        $this->callAction();
        return '';
    }
}