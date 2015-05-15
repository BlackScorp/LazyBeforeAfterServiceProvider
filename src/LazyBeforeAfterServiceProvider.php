<?php
/*
 * This file is part of LazyBeforeAfterServiceProvider.
 *
 * (c) Vitalij Mik <vitalij@blackscorp.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BlackScorp\Silex;


use Silex\Application;
use Silex\CallbackResolver;
use Silex\ServiceProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class LazyBeforeAfterServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     */
    public function register(Application $app)
    {
        /**
         * @var EventDispatcherInterface $dispatcher
         */
        $dispatcher = $app['dispatcher'];
        /**
         * @var CallbackResolver $resolver
         */
        $resolver = $app['callback_resolver'];
        $dispatcher->addSubscriber(new LazyBeforeAfterEventSubscriber($app, $resolver));
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app)
    {
    }

}