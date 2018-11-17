<?php

use Slim\Http\Request;
use Slim\Http\Response;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;


// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});



$app->group('/api', function() use($app){
    $app->get('/prueba','obtenerCrud');
    $app->post('/insertar', 'insertarUsuario');
    
    //$app->
});

