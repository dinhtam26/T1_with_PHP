<?php

namespace Lib;

class RouteItem
{
    public $path;
    public $callback;
    public $method;
    public $middlewares = [];
    public $name;

    public function __construct($path, $callback, $method, $name = null)
    {
        $this->path = $path;
        $this->callback = $callback;
        $this->method = $method;
        $this->name = $name;
    }

    public function middleware($middlewares)
    {
        if (!is_array($middlewares)) {
            $middlewares = [$middlewares];
        }
        $this->middlewares = array_merge($this->middlewares, $middlewares);
        return $this;
    }
}
