<?php declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Commands;

use Salarmotevalli\PhpChecker\FileWorker\ImportedClass;
use Salarmotevalli\PhpChecker\Implementation\AbstractCommand;

class ShortNamespace extends AbstractCommand
{
    public function main()
    {
        (object) $file = new ImportedClass('read.php');
        $prevNamespaces = $file->allImports();
        if (! $prevNamespaces) {
            echo "\033[31m**/\033[0m there is not any namespace of classes in the file \033[31m/**\033[0m" . PHP_EOL;
            exit;
        }
        $validNamespacesArray = $this->getValidNamespacesArray($prevNamespaces);
        $prevContent = $file->content();
        $contentWithouteNamespaces = $this->getContentWithoutNamespace($prevContent, $prevNamespaces);
        $validNamespaces = $this->stringifyValidNamespacesArray($validNamespacesArray);
        $declare = 'declare(strict_types=1);';
        if (str_contains($contentWithouteNamespaces, $declare)) {
            $newContent = str_replace($declare, $declare . PHP_EOL . PHP_EOL . $validNamespaces, $contentWithouteNamespaces);
        } else {
            $newContent = str_replace('<?php', '<?php' . PHP_EOL . PHP_EOL . $validNamespaces, $contentWithouteNamespaces);
        }
        $file->newContent($newContent);
    }

    public static function description(): string
    {
        return 'short namespaces as much as it can be';
    }

    private function getValidNamespacesArray(array $prevNamespaces): array
    {
        (array) $validNamespacesArray = [];
        foreach ($prevNamespaces as $item) {
            (array) $separated = explode('\\', $item);
            (string) $class = end($separated);
            array_pop($separated);
            (string) $namespace = implode('\\', $separated);
            $validNamespacesArray[$namespace][] = $class;
        }

        return $validNamespacesArray;
    }

    private function getContentWithoutNamespace(string $prevContent, array $prevNamespaces): string
    {
        $contentWithouteNamespaces = $prevContent;
        foreach ($prevNamespaces as $name) {
            (string) $fullLineNamespace = 'use' . ' ' . $name . ';';
            $contentWithouteNamespaces = str_replace($fullLineNamespace, '', $contentWithouteNamespaces);
        }

        return $contentWithouteNamespaces;
    }

    private function stringifyValidNamespacesArray(array $validNamespacesArray): string
    {
        (string) $validNamespaces = '';
        foreach ($validNamespacesArray as $name => $class) {
            if (count($class) == 1) {
                (string) $implodeClasses = $class[0];
            } else {
                $implodeClasses = '{' . implode(', ', $class) . '}';
            }
            $validNamespaces .= 'use' . ' ' . $name . '\\' . $implodeClasses . ';' . PHP_EOL;
        }
        return $validNamespaces;
    }
}
