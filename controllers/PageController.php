<?php
  namespace Controllers;

use Models\User;
use Router\Router;

  class PageController {

    public static function index( Router $router ) {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $prueba = new User($_POST);
        $save = $prueba->save();
        debug($save);
      }

      $router->render( 'page/index', [
        'title' => 'Inicio'
      ]);
    }

    public static function NotFound() {
      echo 'Pagina no Encontrada';
    }
  }
