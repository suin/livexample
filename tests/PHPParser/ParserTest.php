<?php

use Livexample\YamlDataProvider;

final class ParserTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider dataForTestParsingLongOutputStatement
     * @param string $phpCode
     * @param string $expected
     */
    public function testParsingLongOutputStatement($phpCode, $expected)
    {
        $actual = \Livexample\PHPParser\Parser::getOutput($phpCode);
        $this->assertSame($expected, $actual);
    }

    /**
     * @return array
     */
    public function dataForTestParsingLongOutputStatement()
    {
        return YamlDataProvider::loadTestCases(__DIR__ . '/long-output-statements.yml');
    }

    /**
     * @dataProvider dataForTestParsingShortOutputStatement
     * @param string $phpCode
     * @param string $expected
     */
    public function testParsingShortOutputStatement($phpCode, $expected)
    {
        $actual = \Livexample\PHPParser\Parser::getOutput($phpCode);
        $this->assertSame($expected, $actual);
    }

    /**
     * @return array
     */
    public function dataForTestParsingShortOutputStatement()
    {
        return YamlDataProvider::loadTestCases(__DIR__ . '/short-output-statements.yml');
    }
}
