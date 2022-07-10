<?php

declare(strict_types=1);

namespace Test\Classes;

use Salarmotevalli\PhpChecker\Classes\Kernel;
use Salarmotevalli\PhpChecker\Classes\Request;

/**
 * @internal
 * @coversNothing
 */
final class KernelTest extends \PHPUnit\Framework\TestCase
{
    public function testMain(): void
    {
        $argc = 1;
        $argv = ['php bin/help'];
        $kernel = new Kernel($argc, $argv);
        self::assertTrue($kernel::$kernel instanceof Kernel);
        self::assertTrue($kernel->request instanceof Request);
    }
}
