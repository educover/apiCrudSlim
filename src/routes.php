<?php

use Slim\Http\Request;
use Slim\Http\Response;



// Routes

//$app->post('/api/insertar', 'insertarUsuario');



$app->group('/api', function() use($app){
    $app->get('/prueba','obtenerCrud');
    $app->post('/insertar', 'insertarUsuario');
    $app->post('/login', 'login');
    //$app->
});

