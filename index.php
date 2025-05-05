<?php

require 'vendor/autoload.php';


use Simonking\Php\Controllers\NewController;

Flight::route('/', function() {
  echo 'hello world! xxx';
});

Flight::route('/json', function() {
  Flight::json(['hello' => 'world xxx']);
});

$newController = new NewController();

Flight::route('/new', [$newController, 'index']);

Flight::route('/new/@id', function($id) use ($newController) {
    $result = $newController->show($id);
    Flight::json($result);
});

$apiController = new \Simonking\Php\Controllers\ApiController();
Flight::route('GET /api/posts', [$apiController, 'getPosts']);
Flight::route('GET /api/posts/@id', [$apiController, 'getPost']);

Flight::start();