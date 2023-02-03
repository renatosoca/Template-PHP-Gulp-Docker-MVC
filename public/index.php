<?php

  require_once __DIR__.'/../includes/App.php';

  use Router\Router;
  use Controllers\PageController;

  $router = new Router();

  //Paginas Publicas
  $router->get( '/', [ PageController::class, 'index' ] );
  $router->get( '/404', [ PageController::class, 'NotFound' ] );

  $router->checkRoutes();
?>