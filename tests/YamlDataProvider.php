<?php

namespace Livexample;

use Symfony\Component\Yaml\Yaml;

final class YamlDataProvider
{
    /**
     * @param string $filename
     * @return array
     */
    public static function loadTestCases($filename)
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
