<?php

require 'vendor/autoload.php';

use Simonking\Php\Controllers\ApiController;

Flight::route('/', function() {
  echo 'hello world!';
});

Flight::route('/hello', function() {
  Flight::json(['hello' => 'world']);
});


$apiController = new ApiController();
Flight::route('GET /api/users', [$apiController, 'getUsers']);
Flight::route('GET /api/user/@id', [$apiController, 'getUser']);

Flight::start();