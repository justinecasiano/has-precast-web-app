<?php
class WebsiteController
{
    private $path;
    private $params;
    private $middlewares;
    private $routes;
    private $rootPath;
    private $repo;

    public function __construct(string $path, array $params, array $routes, $repo)
    {
        $this->path = $path;
        $this->params = $params;
        $this->routes = $routes;
        $this->rootPath = 'website/views/';
        $this->repo = $repo;
        $this->handle();
    }

    public function handle(): void
    {
        $match = $this->findMatch();
        if ($match['file'] !== '404.view.php' && !empty($match['middlewares'])) {
            foreach ($match['middlewares'] as $middleware) {
                $middleware();
            }
        }
        require "$this->rootPath{$match['file']}";
    }

    public function findMatch(): array
    {
        $match['file'] = '404.view.php';

        foreach ($this->routes as $routes) {
            foreach ($routes as $route) {
                [$path, $file] = $route;
                !empty($route[2]) && $match['middlewares'] = $route[2];

                // The pattern matches the following: 
                // { '/', '/index', '/index/', '/index.php', '/index.php?name=Justine' }
                $pattern = "/^\/$path\.?(php|html)?(\?(.+))?\/?$/";

                if (preg_match($pattern, $this->path)) {
                    $match['file'] = $file;
                    break;
                }
            }
        }
        return $match;
    }
}
