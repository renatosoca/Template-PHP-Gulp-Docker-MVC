<?php

require_once __DIR__.'/../app/core/Main.php';

use App\Core\Router;
use App\Controllers\UserController;

Router::get( '/', [ UserController::class, 'index' ] );
Router::get( '/register/:token', [ UserController::class, 'register' ] );
Router::get( '/function', function() {
  echo 'function';
});
Router::get( '/function/:id', function( string $id = '') {
  echo $id;
  echo ' -- function';
});
Router::get('/api/v1/users', function() {
  return [
    'name' => 'example',
    'lastname' => 'example lastname'
  ];
});

Router::dispatch();

?>