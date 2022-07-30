<?php declare(strict_types=1);

namespace Test\FileWorker;

use PHPUnit\Framework\TestCase;
use Salarmotevalli\PhpChecker\FileWorker\Options\ImportedClass;

class ImportedClassTest extends TestCase
{
    public function testValidReturnForAllImportMethod()
    {
        $file = new ImportedClass(__DIR__ . '/test.txt');
        $realResult = ['App\Model\User', 'App\Model\Company', 'App\Model\Comment', 'App\Controller\User', 'App\Http'];
        $testResult = $file->allImports();
        $this->assertEquals($realResult, $testResult);
        $this->assertStringNotContainsString('use', $testResult[0]);
        $this->assertStringNotContainsString(';', $testResult[0]);
        $this->assertStringNotContainsString(' ', $testResult[0]);
    }
}
