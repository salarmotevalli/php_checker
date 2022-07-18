<?php declare(strict_types=1);

namespace Test\FileWorker;

use PHPUnit\Framework\TestCase;
use Salarmotevalli\PhpChecker\FileWorker\ImportedClass;

class ImportedClassTest extends TestCase
{
    public function testValidReturnForAllImportMethod()
    {
        $file = new ImportedClass(__DIR__ . '/test.txt');
        $realResult = ['App\Model\User', 'App\Model\Company', 'App\Model\Comment', 'App\Controller\User', 'App\Http'];
        $testResulte = $file->allImports();
        $this->assertEquals($realResult, $testResulte);
        $this->assertStringNotContainsString('use', $testResulte[0]);
        $this->assertStringNotContainsString(';', $testResulte[0]);
        $this->assertStringNotContainsString(' ', $testResulte[0]);
    }
}
