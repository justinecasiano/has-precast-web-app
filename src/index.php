<?php
// Allows us to set return values for functions and types for parameters
declare(strict_types=1);
require 'utilities/Router.php';
require 'utilities/routes.php';
require 'utilities/middlewares.php';
require 'models/database/Database.php';
require 'models/database/Repository.php';
require '../config/config.php';

if (isset($_SERVER['HTTP_ORIGIN'])) {
    session_name((isset($_SERVER['HTTP_ORIGIN']) && ($_SERVER['HTTP_ORIGIN'] === 'http://admin.has-precast.com')) ? 'SESS-AD' : 'SESS-CLIENT');
}
session_start();

// Create the router object that will route the requests depending on hostname
$router = new Router();
$repo = new Repository(new Database($config));

// All requests with the following HTTP methods of has-precast.com goes here
$router->handle('GET', "has-precast.com@WebsiteController", $routes['website'], $repo);

// All request with the possible HTTP methods of backend.has-precast.com goes here
$router->handle('GET', "backend.has-precast.com@BackendController", $routes['backend'], $repo);
$router->handle('POST', "backend.has-precast.com@BackendController", $routes['backend'], $repo);
