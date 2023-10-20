<?php
require_once './vendor/autoload.php';

use MMWS\Factory\EndpointFactory;

class PathParser
{
    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function interpret($path)
    {
        foreach ($this->routes as $route => $actions) {
            $pattern = $this->buildPattern($route);
            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches); // Remove o primeiro elemento que contém o match completo
                return $this->parseActions($actions, $matches);
            }
        }
        return null;
    }

    private function buildPattern($route)
    {
        $pattern = '/^' . str_replace('/', '\/', $route) . '$/';
        $pattern = preg_replace('/:([^\/]+)/', '(?<$1>[^\/]+)', $pattern);
        return $pattern;
    }

    private function parseActions($actions, $matches)
    {
        $result = [];
        foreach ($actions as $key => $value) {
            if ($key === 'body') {
                $result['body'] = $value;
            } else {
                $result[$key] = $this->parseActions($value, $matches);
            }
        }
        return $result;
    }
}

// Exemplo de uso:
$routeConfig = [
    'path/:param1/:param2' => [
        'body' => EndpointFactory::create()
            ->post('user/manage', 'create')
            ->get('user/manage', 'get')
    ],
    'path/login' => [
        'body' => EndpointFactory::create()
            ->post('user/manage', 'login')
    ]
];

$interpreter = new PathParser($routeConfig);
$route = $interpreter->interpret('path/value1/value2');
var_dump($route);
