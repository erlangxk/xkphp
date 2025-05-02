<?php

namespace Simonking\Php\Controllers;

use Flight;

class NewController
{
    public function index()
    {
       echo 'Welcome to the new controller';
    }
    
    public function show($id): array
    {
        return ['id' => $id, 'data' => 'Sample data for ' . $id];
    }
}