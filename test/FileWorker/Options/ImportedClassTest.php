<?php declare(strict_types=1);

namespace Test\FileWorker;

use PHPUnit\Framework\TestCase;
use Salarmotevalli\PhpChecker\FileWorker\File;
use Salarmotevalli\PhpChecker\FileWorker\Options\ImportedClass;

class ImportedClassTest extends TestCase
{
    public function testValidReturnForUseImportMethod()
    {
        $file = new File(__DIR__ . '/test.txt');
        $realResult = ['App\Model\User', 'App\Model\Company', 'App\Model\Comment', 'App\Controller\User', 'App\Http'];
        $testResult = ImportedClass::useImports($file);
        $this->assertEquals($realResult, $testResult);
        $this->assertStringNotContainsString('use', $testResult[0]);
        $this->assertStringNotContainsString(';', $testResult[0]);
        $this->assertStringNotContainsString(' ', $testResult[0]);
    }

    public function testValidReturnForAllImportMethod()
    {
        $file = new File(__DIR__ . '/test.txt');
        $realResult = ['App\Model\User', 'App\Model\Company', 'App\Model\Comment', 'App\Controller\User', 'App\Http', 'App\Do\User'];
        $testResult = ImportedClass::allImports($file);
        $this->assertEquals($realResult, $testResult);
        $this->assertStringNotContainsString('use', $testResult[0]);
        $this->assertStringNotContainsString(';', $testResult[0]);
        $this->assertStringNotContainsString(' ', $testResult[0]);
    }
}
