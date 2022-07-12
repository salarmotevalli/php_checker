<?php

declare(strict_types=1);

namespace Test\Classes;

use PHPUnit\Framework\TestCase;
use Salarmotevalli\PhpChecker\Classes\Request;

// TODO: test return valid value for flag methods
/**
 * @internal
 * @coversNothing
 */
final class RequestTest extends TestCase
{
    public function testRequestCelassHasMethods(): void
    {
        $argc = 1;
        $argv = ['test'];
        $request = new Request($argc, $argv);
        self::assertTrue(\method_exists($request, 'getOption'));
        self::assertTrue(\method_exists($request, 'getFlag'));
        self::assertTrue(\method_exists($request, 'getOptionKeyValue'));
        self::assertTrue(\method_exists($request, 'getFlagKeyValue'));
        self::assertTrue(\method_exists($request, 'getCommandLength'));
    }

    public function testMethodsReturnValidValue(): void
    {
        $argv = ['php bin/check.php', 'check.php:import'];
        $argc = \count($argv);
        $request1 = new Request($argc, $argv);
        self::assertEquals('check.php:import', $request1->getOption());
        self::assertEquals(['key' => 'check.php', 'value' => 'import'], $request1->getOptionKeyValue());
        self::assertEquals($argc, $request1->getCommandLength());
    }
}
