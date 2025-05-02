<?php

// if installed with composer
require 'vendor/autoload.php';
// or if installed manually by zip file
// require 'flight/Flight.php';

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

Flight::start();