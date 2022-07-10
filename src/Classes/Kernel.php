<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Classes;
require_once __DIR__ . '/../CommandRegister.php';

final class Kernel
{
    public Request $request;
    public static Kernel $kernel;

    public function __construct($argc, $argv)
    {
        self::$kernel = $this;
        $this->request = new Request($argc, $argv);
    }

    public function run(): void
    {
        $commands= commands();
        Execute::execute($this->request, $commands);
    }
}
