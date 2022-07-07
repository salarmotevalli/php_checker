<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker;

final class Kernel
{
    public Route $route;
    public static Kernel $kernel;
    private array $routes = [];

    public function __construct($argc, $argv)
    {
        $this->route = new Route($argc, $argv);
        self::$kernel = $this;
    }

    public function run(): void
    {
        $this->route->resolve();
    }
}
