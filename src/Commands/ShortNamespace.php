<?php declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Commands;

use Salarmotevalli\PhpChecker\FileWorker\File;
use Salarmotevalli\PhpChecker\FileWorker\Options\ClassNamespace;
use Salarmotevalli\PhpChecker\FileWorker\Options\ImportedClass;
use Salarmotevalli\PhpChecker\Implementation\AbstractCommand;

final class ShortNamespace extends AbstractCommand
{
    public static function description(): string
    {
        return 'short namespaces as much as it can be';
    }

    public function main()
    {
        $file = new File('./Graphql/UserType.php');
        $prevNamespaces = ImportedClass::useImports($file);

        if (! $prevNamespaces) {
            echo "\033[31m**/\033[0m there is not any namespace of classes in the file \033[31m/**\033[0m" . PHP_EOL;
            exit;
        }
        $validNamespaces = $this->getValidNamespaces($prevNamespaces);
        $contentWithoutNamespaces = $this->getContentWithoutNamespace($file->content(), $prevNamespaces);
        $newContent = $this->getNewContent($contentWithoutNamespaces, $validNamespaces, $file);
        $file->newContent($newContent);
    }

    private function getValidNamespaces(array $prevNamespaces): string
    {
        return $this->getNamespacesAsString($this->getValidNamespaceArray($prevNamespaces));
    }

    private function getContentWithoutNamespace(string $prevContent, array $prevNamespaces): string
    {
        $contentWithoutNamespaces = $prevContent;
        foreach ($prevNamespaces as $name) {
            $fullLineNamespace = 'use' . ' ' . $name . ';' . PHP_EOL;
            $contentWithoutNamespaces = str_replace($fullLineNamespace, '', $contentWithoutNamespaces);
        }

        return $contentWithoutNamespaces;
    }

    /**
     * @return array|string|string[]
     */
    private function getNewContent(string $contentWithoutNamespaces, string $validNamespaces, $file): string
    {
        if (ClassNamespace::isThereNamespace($file)) {
            $namespace = ClassNamespace::getFullNamespace($file);
            return str_replace($namespace, $namespace . PHP_EOL . PHP_EOL . $validNamespaces, $contentWithoutNamespaces);
        }

        foreach ($this->replacments as $item) {
            if (str_contains($contentWithoutNamespaces, $item)) {
                $replaceKey = $item;
                break;
            }
        }
        $replaceKey = $replaceKey ?? '<?php';

        return str_replace($replaceKey, $replaceKey . PHP_EOL . PHP_EOL . $validNamespaces, $contentWithoutNamespaces);
    }

    /**
     * @param $namespaes
     *
     * @return array
     */
    private array $replacments = [
        'declare(strict_types=1);',
        'declare(strict_types= 1);',
        'declare(strict_types =1);',
        'declare(strict_types = 1);',
        'declare(strict_types=1 );',
        'declare(strict_types= 1 );',
        'declare(strict_types =1 );',
        'declare(strict_types = 1 );',
        'declare( strict_types=1);',
        'declare( strict_types= 1);',
        'declare( strict_types =1);',
        'declare( strict_types = 1);',
        'declare( strict_types=1 );',
        'declare( strict_types= 1 );',
        'declare( strict_types =1 );',
        'declare( strict_types = 1 );',
    
    ];


    private function getValidNamespaceArray($prevNamespaces): array
    {
        $validNamespacesArray = [];
        foreach ($prevNamespaces as $item) {
            $separated = explode('\\', $item);
            (string) $class = end($separated);
            array_pop($separated);
            $namespace = implode('\\', $separated);
            $validNamespacesArray[$namespace][] = $class;
        }

        return $validNamespacesArray;
    }

    private function getNamespacesAsString(array $validNamespacesArray): string
    {
        $validNamespaces = '';
        foreach ($validNamespacesArray as $name => $class) {
            if (count($class) == 1) {
                $implodeClasses = $class[0];
            } else {
                $implodeClasses = '{' . implode(', ', $class) . '}';
            }
            $validNamespaces .= 'use' . ' ' . $name . '\\' . $implodeClasses . ';' . PHP_EOL;
        }

        return $validNamespaces;
    }
}
