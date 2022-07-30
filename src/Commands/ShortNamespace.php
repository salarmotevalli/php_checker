<?php declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Commands;

use Salarmotevalli\PhpChecker\FileWorker\File;
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
        (object) $file = new File('read.php');
        $file->openFileForRead();
        $prevNamespaces = ImportedClass::allImports($file);
        var_dump($prevNamespaces);
//        if (! $prevNamespaces) {
//            echo "\033[31m**/\033[0m there is not any namespace of classes in the file \033[31m/**\033[0m" . PHP_EOL;
//            exit;
//        }
//        $validNamespacesArray = $this->getValidNamespacesArray($prevNamespaces);
//        $contentWithoutNamespaces = $this->getContentWithoutNamespace($file->content(), $prevNamespaces);
//        $validNamespaces = $this->stringifyValidNamespacesArray($validNamespacesArray);
//        $newContent = $this->getNewContent($contentWithoutNamespaces, $validNamespaces);
//        $file->newContent($newContent);
        echo "khare";
    }

    private function getValidNamespacesArray(array $prevNamespaces): array
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

    private function getContentWithoutNamespace(string $prevContent, array $prevNamespaces): string
    {
        $contentWithoutNamespaces = $prevContent;
        foreach ($prevNamespaces as $name) {
            $fullLineNamespace = 'use' . ' ' . $name . ';' . PHP_EOL;
            $contentWithoutNamespaces = str_replace($fullLineNamespace, '', $contentWithoutNamespaces);
        }

        return $contentWithoutNamespaces;
    }

    private function stringifyValidNamespacesArray(array $validNamespacesArray): string
    {
        $validNamespaces = '';
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

    /**
     * @return array|string|string[]
     */
    public function getNewContent(string $contentWithoutNamespaces, string $validNamespaces): string|array
    {
        $declare = 'declare(strict_types=1);';
        $replaceKey = str_contains($contentWithoutNamespaces, $declare) ? $declare : '<?php';

        return str_replace($replaceKey, $replaceKey . PHP_EOL . PHP_EOL . $validNamespaces, $contentWithoutNamespaces);
    }
}
