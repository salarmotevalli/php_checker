<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker;

final class Request
{
    private array $args;
    private int $argv;

    public function __construct($argc, $argv)
    {
        $this->args = $argc;
        $this->argv = $argv;
    }

    public function getOption(): null|string
    {
        if (isset($this->args[2])) {
            return $this->args[2];
        }

        return null;
    }

    public function getFlag(): null|string
    {
        if (isset($this->args[2])) {
            return $this->args[2];
        }

        return null;
    }
}
