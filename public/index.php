<?php
ob_start();

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();





//Conexxión a BD
function getConnection(){
    $dbhost="127.0.0.1";
    $dbuser="root";
    $dbpass="";
    $dbname="crudangularphp";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

//Obtener Crud
function obtenerCrud(){
    $sql = "SELECT * FROM crud";
    try{
        $stmt = getConnection()->query($sql);
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        return json_encode($usuarios);
    } catch (PDOException $e){
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

//Insertar Usuario




function insertarUsuario(ServerRequestInterface $request, ResponseInterface $response){
        
    $json = $request->getBody();
        $data = decode($json);
        $sql = "INSERT INTO crud (nombre, telefono, direccion, fechaNacimiento) VALUES ('pepe', 'eee', 'dddddd', 'ssse');";
        try{
            $stmt = getConnection()->query($sql);
            $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
    
            //return json_encode($usuarios);
        } catch (PDOException $e){
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
}

header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
ob_end_flush();