<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include('middleware/Auth.php');
use App\middleware;
require '../vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['db']['host'] = "localhost";
$config['db']['user'] = "root";
$config['db']['pass'] = "root";
$config['db']['dbname'] = "susu";


$app = new \Slim\App(['settings' => $config]);
$container = $app->getContainer();

//https://github.com/slimphp/Slim/issues/1529#issuecomment-341734546
$container['environment'] = function () {
    // Fix the Slim 3 subdirectory issue (#1529)
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $_SERVER['REAL_SCRIPT_NAME'] = $scriptName;
    $_SERVER['SCRIPT_NAME'] = dirname(dirname($scriptName)) . '/' . basename($scriptName);
    return new Slim\Http\Environment($_SERVER);
};

$container['view'] = new \Slim\Views\PhpRenderer("templates/");

$container['logger'] = function ($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

// Auth middleware

// Auth middleware
$container['Auth'] = function ($c) {
    return new App\middleware\Auth($c->get('router'));
};
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$app->get('/', function (Request $request, Response $response) {
    $this->logger->addInfo("Loading home page");
    $response = $this->view->render($response, "index.phtml");
    return $response;
});

$app->get('/loginPage', function (Request $request, Response $response) {
    $this->logger->addInfo("Loading Login Page");
    $response = $this->view->render($response, "login.phtml");

    return $response;
});




$app->run();

