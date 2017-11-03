<?php

namespace Livexample\FileSystem;

final class FileFinder
{
    /**
     * @param string $directory
     * @param string $fileExtension
     * @return array
     */
    public static function filesInDir($directory, $fileExtension)
    {
        $it =
            new \RegexIterator(
                new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator(realpath($directory)),
                    \RecursiveIteratorIterator::LEAVES_ONLY),
                '(\.' . preg_quote($fileExtension) . '$)'
            );
        $fileNames = array();
        foreach ($it as $file) {
            /** @var \SplFileInfo $file */
            $fileNames[] = $file->getPathname();
        }
        sort($fileNames);
        return $fileNames;
    }
}
