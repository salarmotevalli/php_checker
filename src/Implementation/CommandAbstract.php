<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Implementation;

abstract class CommandAbstract implements CommandInterface
{
    final public function run(): void
    {
        \print_r($this->welcom() . \PHP_EOL);
        $this->main();
    }

    final public function welcom(): string
    {
        return
              '___________________________' . \PHP_EOL
            . ' welcome to php ckecker...' . \PHP_EOL
            . '___________________________' . \PHP_EOL
            . '      salar motevalli' . \PHP_EOL
            . '    ___________________' . \PHP_EOL;
    }

    abstract public function main();
}
