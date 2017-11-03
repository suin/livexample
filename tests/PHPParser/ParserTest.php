<?php

use Symfony\Component\Yaml\Yaml;

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
        return self::loadTestCases(__DIR__ . '/long-output-statements.yml');
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
        return self::loadTestCases(__DIR__ . '/short-output-statements.yml');
    }

    /**
     * @param string $filename
     * @return array
     */
    private static function loadTestCases($filename)
    {
        $result = Yaml::parse(file_get_contents($filename));
        return array_reduce($result, function (array $l, array $r) use ($filename) {
            list($name, $code, $expected) = $r;
            if (array_key_exists($name, $l)) {
                throw new \Exception("Duplicated key '$name' found in $filename");
            }
            return array_merge($l, array($name => array($code, rtrim($expected))));
        }, array());
    }
}
