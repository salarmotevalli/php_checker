<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Classes;

use Salarmotevalli\PhpChecker\Commands\Main;
require_once __DIR__ . '/../CommandRegister.php';

final class Execute
{
    private static ?array $commands;
    private static ?Request $request;

    public static function execute($request): void
    {
        self::$request = $request;
        self::setCommands();
        $class = self::getCommandClass();
        self::executer($class);
    }

    private static function setCommands(): void
    {
        self::$commands = commands();
    }

    private static function getCommandClass()
    {
        $length = self::$request->getCommandLength();

        if (1 === $length) {
            return Main::class;
        }
//
//        if ($length > 1){
//            self::$request->getOptionKeyValue()
//        }
    }

    private static function executer(string $class): void
    {
        $command = new $class();
        $command->run();
    }
}
