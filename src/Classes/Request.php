<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Classes;

final class Request
{
    private int $argc;
    private array $argv;

    public function __construct($argc, $argv)
    {
        $this->argc = $argc;
        $this->argv = $argv;
    }

    public function getOption(): null|string
    {
        return $this->argv[1] ?? null;
    }

    public function getFlag(): null|string
    {
        return $this->argv[2] ?? null;
    }
}
