<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Implementation;

abstract class CommandAbstract implements CommandInterface
{
    final public function run(): void
    {
        print_r('hello');
    }
}
