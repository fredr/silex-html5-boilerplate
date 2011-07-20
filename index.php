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


// include css
$app->get('/css/{path}.css', function($path) {
    if ($file = @file_get_contents(__DIR__."/web/css/$path.css"))
      return new Response($file, 200, array('Content-Type' => 'text/css'));

    throw new NotFoundHttpException();
});

// include js
$app->get('/js/{path}.js', function($path) {
    if ($file = @file_get_contents(__DIR__."/web/js/$path.js"))
      return new Response($file, 200, array('Content-Type' => 'text/javascript'));

    throw new NotFoundHttpException();
});

// include images
$app->get('/images/{path}.{ext}', function($path, $ext) {

    if (!in_array(strtolower($ext), array("jpg", "jpeg", "png", "gif"))) {
      throw new NotFoundHttpException();
    }

    $contentType = "image/{strtolower($ext)}";
    if (strtolower($ext) == "jpg")
      $contentType = "image/jpeg";

    if ($file = @file_get_contents(__DIR__."/web/images/$path.$ext")) {
      return new Response($file, 200, array('Content-Type' => "$contentType"));
    }

    throw new NotFoundHttpException();
});

$app->run();

?>