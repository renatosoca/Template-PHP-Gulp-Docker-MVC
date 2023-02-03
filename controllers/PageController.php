<?php
  namespace Controllers;

  use Router\Router;

  class PageController {

    public static function index( Router $router ) {
      $router->render( 'page/index', [
        'title' => 'Inicio'
      ]);
    }

    public static function NotFound() {
      echo 'Errorrr';
    }
  }
