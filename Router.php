<?php

namespace Router;

class Router
{
  public array $getRoutes = [];
  public array $postRoutes = [];

  public function get(string $url, array $fn): void
  {
    $this->getRoutes[$url] = $fn;
  }

  public function post(string $url, array $fn): void
  {
    $this->postRoutes[$url] = $fn;
  }

  public function checkRoutes(): bool | null
  {
    $currentUrl = $_SERVER['REQUEST_URI'] ?? '/';
    $validUrls = explode('?', $currentUrl)[0];

    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'GET') $fn = $this->getRoutes[$validUrls] ?? null;
    if ($method === 'POST') $fn = $this->postRoutes[$validUrls] ?? null;

    if (!$fn) return header('Location: /404');

    return call_user_func($fn, $this);
  }

  public function render(string $view, array $data = []): string
  {
    foreach ($data as $key => $value) {
      $$key = $value;
    }

    ob_start();
    include_once __DIR__ . "/views/$view.html";
    $content = ob_get_clean();
    include_once __DIR__ . '/views/layout.php';
    return $content;
  }
}
