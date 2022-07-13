<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Classes;

use Salarmotevalli\PhpChecker\Commands\Main;
use Salarmotevalli\PhpChecker\Implementation\CommandInterface;

final class Execute
{
    private static ?array $commands;

    private static ?Request $request;

    public static function execute(Request $request, $commands): void
    {
        self::$request = $request;
        self::setCommands($commands);
        $class = self::getCommandClass();
        self::executer($class);
    }

    public static function getCommands(): ?array
    {
        return self::$commands;
    }

    private static function setCommands($commands): void
    {
        self::$commands = $commands;
    }

    private static function getCommandClass(): ?CommandInterface
    {
        $length = self::$request->getCommandLength();

        if ($length === 1) {
            return new Main(self::$commands);
        }

        if ($length > 1) {
            $option = self::$request->getOptionKeyValue();

            try {
                $command = self::$commands[$option['key']][$option['value']] ?? null;

                if ($command === null) {
                    throw new \Exception('command not found' . \PHP_EOL);
                }

                return new $command();
            } catch (\Exception $e) {
                echo $e->getMessage();

                return new Main(self::$commands);
            }
        }
    }

    private static function executer(CommandInterface $command): void
    {
        $command->run();
    }
}
