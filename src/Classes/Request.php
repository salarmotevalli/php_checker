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

    public function getOptionKeyValue(): array
    {
        if (1 < $this->argc) {
            $option = \explode(':', $this->getOption());
        }

        return [
            'key' => $option[0] ?? null,
            'value' => $option[1] ?? null,
        ];
    }

    public function getFlagKeyValue(): array
    {
        if (2 < $this->argc) {
            $flag = \explode('=', $this->getFlag());
        }

        return [
            'key' => $flag[0],
            'value' => $flag[1],
        ];
    }

    public function getCommandLength()
    {
        return $this->argc;
    }
}
