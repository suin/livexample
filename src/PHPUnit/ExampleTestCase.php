<?php

namespace Livexample\PHPUnit;

use Livexample\FileSystem\FileFinder;
use Livexample\PHPParser\Parser;
use PHPUnit\Framework\TestCase;

abstract class ExampleTestCase extends TestCase
{
    /**
     * @var string
     */
    private $xDebugOverloadVarDump;

    /**
     * @return string[]
     */
    abstract public function exampleFiles();

    /**
     * @before
     */
    final public function disableXDebugVarDump()
    {
        if (extension_loaded('xdebug') && xdebug_is_enabled()) {
            $this->xDebugOverloadVarDump = ini_get('xdebug.overload_var_dump');
            ini_set('xdebug.overload_var_dump', 0);
        }
    }

    /**
     * @after
     */
    final public function enableXDebugVarDump()
    {
        if ($this->xDebugOverloadVarDump) {
            ini_set('xdebug.overload_var_dump', $this->xDebugOverloadVarDump);
        }
    }

    /**
     * @param string $filename
     * @dataProvider provideExampleFiles
     */
    final public function testExamples($filename)
    {
        $sourceCode = file_get_contents($filename);
        $expectedOutput = trim(Parser::getOutput($sourceCode));

        ob_start();
        /** @noinspection PhpIncludeInspection */
        require $filename;
        $actualOutput = trim(ob_get_clean());
        $this->assertEquals($expectedOutput, $actualOutput);
    }

    /**
     * @return array
     */
    final public function provideExampleFiles()
    {
        return array_map(function ($filename) {
            return array($filename);
        }, $this->exampleFiles());
    }

    /**
     * @param string $directory
     * @param string $fileExtension
     * @return array
     */
    final protected static function exampleDirectory($directory, $fileExtension = 'php')
    {
        return FileFinder::filesInDir($directory, $fileExtension);
    }
}
