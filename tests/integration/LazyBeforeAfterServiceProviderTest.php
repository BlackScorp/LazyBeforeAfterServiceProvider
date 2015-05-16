<?php
/*
 * This file is part of LazyBeforeAfterServiceProvider.
 *
 * (c) Vitalij Mik <vitalij@blackscorp.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use BlackScorp\Silex\LazyBeforeAfterServiceProvider;
use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use BlackScorp\Silex\Test\Spy;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class LazyBeforeAfterServiceProviderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Application
     */
    private $app;


    public function setUp()
    {
        $app = new Application();
        $app->register(new ServiceControllerServiceProvider());
        $app->register(new LazyBeforeAfterServiceProvider());
        $app->get('/','controller:indexAction');
        $this->app = $app;

    }

    private function executeSilex()
    {
        $request = Request::create('/');
        return $this->app->handle($request);
    }
    public function testNone(){
        $app = $this->app;
        $spy = new Spy\ControllerOnlyActionSpy();
        $app['controller'] = $app->share(function () use ($spy) {
            return $spy;
        });
        $this->executeSilex();

        $this->assertFalse($spy->beforeCalled());
        $this->assertFalse($spy->beforeActionCalled());
        $this->assertTrue($spy->actionCalled());
        $this->assertFalse($spy->afterActionCalled());
        $this->assertFalse($spy->afterCalled());
    }
    public function testBeforeCallOnly()
    {
        $app = $this->app;
        $spy = new Spy\ControllerWithBeforeOnlySpy();
        $app['controller'] = $app->share(function () use ($spy) {
            return $spy;
        });
        $this->executeSilex();

        $this->assertTrue($spy->beforeCalled());
        $this->assertFalse($spy->beforeActionCalled());
        $this->assertTrue($spy->actionCalled());
        $this->assertFalse($spy->afterActionCalled());
        $this->assertFalse($spy->afterCalled());
    }
    public function testBeforeActionOnly(){
        $app = $this->app;
        $spy = new Spy\ControllerWithBeforeActionOnlySpy();
        $app['controller'] = $app->share(function () use ($spy) {
            return $spy;
        });
        $this->executeSilex();

        $this->assertFalse($spy->beforeCalled());
        $this->assertTrue($spy->beforeActionCalled());
        $this->assertTrue($spy->actionCalled());
        $this->assertFalse($spy->afterActionCalled());
        $this->assertFalse($spy->afterCalled());
    }
    public function testAfterActionOnly(){
        $app = $this->app;
        $spy = new Spy\ControllerWithAfterActionOnlySpy();
        $app['controller'] = $app->share(function () use ($spy) {
            return $spy;
        });
        $this->executeSilex();

        $this->assertFalse($spy->beforeCalled());
        $this->assertFalse($spy->beforeActionCalled());
        $this->assertTrue($spy->actionCalled());
        $this->assertTrue($spy->afterActionCalled());
        $this->assertFalse($spy->afterCalled());
    }
    public function testAfterOnly(){
        $app = $this->app;
        $spy = new Spy\ControllerWithAfterOnlySpy();
        $app['controller'] = $app->share(function () use ($spy) {
            return $spy;
        });
        $this->executeSilex();

        $this->assertFalse($spy->beforeCalled());
        $this->assertFalse($spy->beforeActionCalled());
        $this->assertTrue($spy->actionCalled());
        $this->assertFalse($spy->afterActionCalled());
        $this->assertTrue($spy->afterCalled());
    }

    public function testAll(){
        $app = $this->app;
        $spy = new Spy\ControllerWithAllSpy();
        $app['controller'] = $app->share(function () use ($spy) {
            return $spy;
        });
        $this->executeSilex();

        $this->assertTrue($spy->beforeCalled());
        $this->assertTrue($spy->beforeActionCalled());
        $this->assertTrue($spy->actionCalled());
        $this->assertTrue($spy->afterActionCalled());
        $this->assertTrue($spy->afterCalled());
    }
    public function testOrderOfCalls(){
        $app = $this->app;
        $spy = new Spy\ControllerWithOrderSpy();
        $app['controller'] = $app->share(function () use ($spy) {
            return $spy;
        });
        $this->executeSilex();
        $this->assertSame('before|beforeIndexAction|indexAction|afterIndexAction|after',$spy->getOrderIndicator());
    }
    public function testSubRequestWithBeforeOnly(){
        $app = $this->app;
        $spy = new Spy\ControllerWithAllSpy();
        $app['controller'] = $app->share(function () use ($spy) {
            return $spy;
        });

        $request = Request::create('/');

        $this->app['kernel']->handle($request, HttpKernelInterface::SUB_REQUEST);

        $this->assertFalse($spy->beforeCalled());
        $this->assertFalse($spy->beforeActionCalled());
        $this->assertFalse($spy->actionCalled());
        $this->assertFalse($spy->afterActionCalled());
        $this->assertFalse($spy->afterCalled());
    }

    public function testResponseInMiddlewares(){
        $app = $this->app;
        $spy = new Spy\ControllerWithSymfonyResponseSpy();
        $app['controller'] = $app->share(function () use ($spy) {
            return $spy;
        });
        $this->executeSilex();

        $this->assertTrue($spy->beforeCalled());
        $this->assertTrue($spy->beforeActionCalled());
        $this->assertFalse($spy->actionCalled());
        $this->assertTrue($spy->afterActionCalled());
        $this->assertTrue($spy->afterCalled());
    }

}
