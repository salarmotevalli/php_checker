<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Commands;

use Salarmotevalli\PhpChecker\Implementation\AbstractCommand;

require_once __DIR__ . '/../CommandRegister.php';

final class Main extends AbstractCommand
{
    protected array $commands;

    public function __construct($commands)
    {
        $this->commands = $commands;
    }

    public function main(): void
    {
        $this->usage();
        $this->commands();
    }

    public static function description(): string
    {
        return 'check.php the class imports';
    }

    private function usage(): void
    {
        \print_r(value: "USAGE => \033[36m/vendor/bin/check.php \033[33m<optin> \033[31m[flag]\033[0m" . \PHP_EOL);
        \print_r(value: "example => \033[36m/vendor/bin/check.php \033[33mcheck:\033[35mimport \033[31m--file=app/http/controller/UserControler.php" . \PHP_EOL . \PHP_EOL);
    }

    private function commands(): void
    {
        $commands = $this->commands;
        echo "  \033[32m <option>:" . \PHP_EOL;

        foreach ($commands as $parent => $subs) {
            echo "    \033[33m {$parent}:" . \PHP_EOL;

            foreach ($subs as $sub => $class) {
                echo "      \033[35m {$sub} \033[0m" . $this->dot($sub);
                echo "  {$class::description()}" . \PHP_EOL;
//                echo " some colored text \ some white text \n";
            }
        }
    }

    private function dot($sub): string
    {
        $dot = ' ';
        $count = 20 - \mb_strlen($sub);
        $dot .= \str_repeat('.', $count + 1);

        return $dot;
    }
}
