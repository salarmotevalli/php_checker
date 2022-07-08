<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Classes;

final class Kernel
{
    public Request $request;
    public static Kernel $kernel;

    public function __construct($argc, $argv)
    {
        self::$kernel = $this;
        $this->request = new Request($argc, $argv);
        \print_r($this->request->getOptionKeyValue());
    }
}
