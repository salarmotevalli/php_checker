<?php

declare(strict_types=1);

namespace Test\Classes;

use PHPUnit\Framework\TestCase;
use Salarmotevalli\PhpChecker\Classes\Execute;

/**
 * @internal
 * @coversNothing
 */
final class ExecuteTest extends TestCase
{
    public function testMethodIsExist(): void
    {
        self::assertTrue(\method_exists(Execute::class, 'execute'));
        self::assertTrue(\method_exists(Execute::class, 'setCommands'));
        self::assertTrue(\method_exists(Execute::class, 'getCommandClass'));
        self::assertTrue(\method_exists(Execute::class, 'execute'));
    }
}
