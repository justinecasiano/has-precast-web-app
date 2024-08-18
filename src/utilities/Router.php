<?php
require 'backend/BackendController.php';
require 'website/WebsiteController.php';

class Router
{
    public function handle(string $method, string $uri, array $routes, $repo): void
    {
        list($host, $controller) = explode('@', $uri);

        if ($host === $_SERVER['HTTP_HOST']) {
            if ($method === $_SERVER['REQUEST_METHOD']) {
                new $controller($this->getPath(), $this->getParams($method), $routes, $repo);
            }
        }
    }

    public function getPath(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getParams(string $method): array
    {
        return [
            'GET' => $_GET,
            'POST' => $_POST
        ][$method];
    }
}
