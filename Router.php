<?php
namespace Router;

class Router {
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get( string $url, array $fn ): void {
        $this->getRoutes[$url] = $fn;
    }

    public function post( string $url, array $fn ): void {
        $this->postRoutes[$url] = $fn;
    }

    public function checkRoutes(): bool | null {
        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') $fn = $this->getRoutes[$currentUrl] ?? null;
        if ( $method === 'POST' ) $fn = $this->postRoutes[$currentUrl] ?? null; 

        if ( !$fn ) return header('Location: /404'); 
        
        // Call user fn va a llamar una función cuando no sabemos cual sera
        return call_user_func($fn, $this); // This es para pasar argumentos
    }

    public function render( string $view, array $data = [] ): string {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        
        ob_start(); // Almacenamiento en memoria durante un momento...
        // entonces incluimos la vista en el layout
        include_once __DIR__ . "/views/$view.php";
        $content = ob_get_clean(); // Limpia el Buffer
        include_once __DIR__ . '/views/layout.php';
        return $content;
    }
}