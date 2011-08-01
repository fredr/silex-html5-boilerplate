<?php
/**
 * Author: Fredrik Enestad @ Devloop AB (fredrik@devloop.se)
 * Date: 2011-07-19
 * Time: 10:48 
 */
 
require_once __DIR__.'/vendor/silex/silex.phar';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

$app = new Silex\Application();

// set debuggin mode if localhost
if ($_SERVER['REMOTE_ADDR'] == "127.0.0.1")
  $app['debug'] = true;

// register database
$app->register(new Silex\Extension\DoctrineExtension(), array(
    'db.options' => array(
        'driver'        => 'pdo_mysql',
        'host'          => 'localhost',
        'user'          => 'username',
        'password'      => 'password',
        'dbname'        => 'database_name',
        'charset'       => 'UTF8',
        'driverOptions' => array(
            'charset' => 'UTF8'
        )
    ),
    'db.dbal.class_path'    => __DIR__.'/vendor/doctrine2-dbal/lib',
    'db.common.class_path'  => __DIR__.'/vendor/doctrine2-common/lib',
));

// register twig
$app->register(new Silex\Extension\TwigExtension(), array(
    'twig.path'       => __DIR__.'/views',
    'twig.class_path' => __DIR__.'/vendor/twig/lib',
));

// handle errors
$app->error(function (\Exception $e) use ($app) {
    if ($app['debug']) return;
    
    if ($e instanceof NotFoundHttpException) {
      if ($file = @file_get_contents(__DIR__."/web/404.html"))
        return new Response($file, 404, array('Content-Type' => 'text/html'));

      return new Response('The requested page could not be found.', 404);
    }

    $code = ($e instanceof HttpException) ? $e->getStatusCode() : 500;
    return new Response('We are sorry, but something went terribly wrong.', $code);
});

return $app;

?>