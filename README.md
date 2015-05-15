# LazyBeforeAfterServiceProvier

A service Provider for [Silex](http://silex.sensiolabs.org/) to call before/after methods automatically.

#Usage

Your bootstrap may look like this
~~~ php
<?php
$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new LazyBeforeAfterServiceProvider());
$app['controller'] = $app->share(function(){
return MyController();
});
$app->get('/','controller:indexAction');
~~~

Now you can just add methods like "before", "after","before{MethodName}" and "after{MethodName}" without to specify it in your Router.

This is the same like

~~~
$app->get('/','controller:indexAction')
->before(function(){
//some logic
})->after(function(){
//some logic
});
~~~

But with the ability to do your checks in a "Base" Controller and extend from it.

The Provider Call the methods in following Order:

1. Before
2. BeforeAction
3. Action(Called by Silex)
4. AfterAction
5. After

