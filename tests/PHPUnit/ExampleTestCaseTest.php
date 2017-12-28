<?php

use Livexample\PHPUnit\ExampleTestCase;

class ExampleTestCaseTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var int
     */
    private $outputLevel;

    /**
     * @before
     */
    public function backupOutputLevel()
    {
        $this->outputLevel = ob_get_level();
    }

    /**
     * @after
     */
    public function restoreOutputLevel()
    {
        // When running PHPUnit inside PHPUnit, the output buffer level changes.
        while (ob_get_level() > $this->outputLevel) {
            ob_end_clean();
        }
        while (ob_get_level() < $this->outputLevel) {
            ob_start();
        }
    }

    public function testLiveExamplesTest()
    {
        $testSuite = new \PHPUnit\Framework\TestSuite(
            'LiveExamplesTest'
        );
        $testResult = $testSuite->run();
//        $this->printResult($testResult);
        $this->assertSame(3, $testResult->count());
        $this->assertSame(0, $testResult->failureCount());
        $this->assertSame(0, $testResult->errorCount());
        $this->assertSame(0, $testResult->skippedCount());
        $this->assertSame(0, $testResult->notImplementedCount());
        $this->assertSame(0, $testResult->riskyCount());
        if (version_compare(self::getPHPUnitVersion(), '5.0.0', '>'))
            $this->assertSame(0, $testResult->warningCount());
    }

    public function testBrokenExamplesTest()
    {
        $testSuite = new \PHPUnit\Framework\TestSuite(
            'BrokenExamplesTest'
        );
        $testResult = $testSuite->run();
//        $this->printResult($testResult);
        $this->assertSame(2, $testResult->count());
        $this->assertSame(2, $testResult->failureCount());
        $this->assertSame(0, $testResult->errorCount());
        $this->assertSame(0, $testResult->skippedCount());
        $this->assertSame(0, $testResult->notImplementedCount());
        $this->assertSame(0, $testResult->riskyCount());
        if (version_compare(self::getPHPUnitVersion(), '5.0.0', '>'))
            $this->assertSame(0, $testResult->warningCount());
    }

    private static function printResult($result)
    {
        /** @noinspection PhpUndefinedClassInspection */
        $resultPrinter = class_exists('\PHPUnit\TextUI\ResultPrinter')
            ? new \PHPUnit\TextUI\ResultPrinter()
            : new \PHPUnit_TextUI_ResultPrinter(); // PHPUnit 4.8

        $resultPrinter->printResult($result);
    }

    /**
     * @return string
     */
    private static function getPHPUnitVersion()
    {
        /** @noinspection PhpUndefinedClassInspection */
        return class_exists('\PHPUnit\Runner\Version')
            ? \PHPUnit\Runner\Version::id()
            : \PHPUnit_Runner_Version::id();
    }
}

class LiveExamplesTest extends ExampleTestCase
{
    public function exampleFiles()
    {
        return self::exampleDirectory(__DIR__ . '/live-examples');
    }
}

class BrokenExamplesTest extends ExampleTestCase
{
    public function exampleFiles()
    {
        return self::exampleDirectory(__DIR__ . '/broken-examples');
    }
}
