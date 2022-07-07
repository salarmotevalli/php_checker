<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker;

final class Route
{
    private array $args;
    private int $argv;

    public function __construct($argc, $argv)
    {
        $this->args = $argc;
        $this->argv = $argv;
    }

    public function resolve(): void
    {
    }

    public function getOption(): void
    {
    }

    public function getFlag(): void
    {
    }
}
