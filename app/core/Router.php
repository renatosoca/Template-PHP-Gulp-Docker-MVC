<?php

namespace App\Core;

class Router {
  
  private static array $routes = [];

  public static function get(string $uri, $callback): void {
    $uri = trim($uri,"/");
    self::$routes["GET"][$uri] = $callback;

    return;
  }

  public static function post(string $uri, $callback): void {
    $uri = trim($uri,"/");
    self::$routes["POST"][$uri] = $callback;

    return;
  }

  public static function dispatch(): void {
    
    $uri = $_SERVER["REQUEST_URI"];
    $uri = trim($uri,"/");
    $validUri = explode("?",$uri)[0];

    $method=$_SERVER["REQUEST_METHOD"];

    foreach (self::$routes[$method] as $route => $callback) {
      if(strpos($route,":")) $route = preg_replace("#:[a-zA-Z0-9]+#","([a-zA-Z0-9]+)",$route);
      
      if(preg_match("#^$route$#", $validUri, $matches)) {
          
        $params = array_slice($matches,1);
        
        if(is_callable($callback)) $response = $callback(...$params);

        if(is_array($callback)) {
          $controller = new $callback[0];
          $response   = $controller->{$callback[1]}(...$params);
        }
        
        if(is_array($response) || is_object($response)) {
          header("Content-Type: application/json");
          echo json_encode($response);
        }else{
          echo $response;
        }

        return;
      }
    }

    messageError("DISPATCH ERROR: Error 404, Page not found");
    return;
  }

  public static function render(string $view, string $layout, array $data = []): string {

    if(
      file_exists(__DIR__ ."/../views/$view.php") &&
      file_exists(__DIR__ . "/../views/layouts/$layout.php")
    ) {
      extract($data);
      
      ob_start();
      include_once __DIR__ . "/../views/$view.php";
      $content = ob_get_clean();

      include_once __DIR__ . "/../views/layouts/$layout.php";

      return $content;
    }
    
    return messageError("RENDER ERROR: View or layout not found");
  }

  public static function redirect(string $route): void{
    header("Location: {$route}");
    return;
  }

}