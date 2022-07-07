<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker;

final class Kernel
{
    public Route $route;
    private $routes = [];

    public function __construct($argc, $argv)
    {
        $this->route = new Route($argc, $argv);
    }

    public function run(): void
    {
        echo 'ok';
        $this->route->resolve();
    }

    public function set($option, ...$flag): void
    {
    }
}
