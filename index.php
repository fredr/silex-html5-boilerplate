<?php
/**
 * Author: Fredrik Enestad @ Devloop AB (fredrik@devloop.se)
 * Date: 2011-07-19
 * Time: 10:56 
 */

$app = require __DIR__ . "/bootstrap.php";

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

$app->get("/", function() use($app) {
    return $app['twig']->render("index.twig");
});

$app->run();

?>