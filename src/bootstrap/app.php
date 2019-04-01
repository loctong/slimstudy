<?php
/**
 * Created by PhpStorm.
 * User: Tong Bao Loc
 * Date: 4/1/2019
 * Time: 11:03 AM
*/
session_start();
require __DIR__ . '/../../vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['db']['host'] = "localhost";
$config['db']['user'] = "root";
$config['db']['pass'] = "root";
$config['db']['dbname'] = "susu";

$user = new \App\Models\User();
var_dump($user);
die();

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

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

require  __DIR__ . '/../app/route.php';