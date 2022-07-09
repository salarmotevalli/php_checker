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
        return 'welcome to php ckecker...' . \PHP_EOL
            . '_______________________' . \PHP_EOL
            . '  ___________________' . \PHP_EOL
            . '    _______________' . \PHP_EOL
            . '      ___________' . \PHP_EOL
            . '        _______';
    }


    abstract public function main();
}
