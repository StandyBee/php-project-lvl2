<?php

namespace Differ\Differ;

use Exception;

use function Differ\Parsers\parse;

function genDiff($firstFile, $secondFile)
{
    $file1 = parse(getFileExtension($firstFile), getFileContent($firstFile));
    $file2 = parse(getFileExtension($secondFile), getFileContent($secondFile));

    $file1 = (array) $file1;
    $file2 = (array) $file2;

    $merge = array_merge($file1, $file2);
    $keys = array_keys($merge);
    sort($keys);

    $mapped = array_map(static function ($key) use ($merge, $file1, $file2) {
        if (is_bool($merge[$key])) {
            $merge[$key] = $merge[$key] ? 'true' : 'false';
        }
        if (!array_key_exists($key, $file2)) {
            return '  - ' . $key . ': ' . $merge[$key];
        }
        if (!array_key_exists($key, $file1)) {
            return '  + ' . $key . ': ' . $merge[$key];
        }
        if (array_key_exists($key, $file1) && array_key_exists($key, $file2)) {
            if ($file1[$key] === $file2[$key]) {
                return '    ' . $key . ': ' . $merge[$key];
            }
            return '  - ' . $key . ': ' . $file1[$key] . "\n" . '  + ' . $key . ': ' . $file2[$key];
        }
    }, $keys);
    $string = implode("\n", $mapped);
    $result = '{' . "\n" . $string . "\n" . '}';
    return $result;
}

function getFileExtension(string $path): string
{
    if (file_exists($path)) {
        $extension = pathinfo($path, PATHINFO_EXTENSION);
    } else {
        throw new Exception("File $path not exists.");
    }

    return $extension;
}

function getFileContent(string $path): string
{
    if (is_readable($path)) {
        $fileData = file_get_contents($path);
    } else {
        throw new Exception("File $path not exists or not readable.");
    }

    if (is_string($fileData)) {
        return $fileData;
    } else {
        throw new Exception("File $path content is not in string format.");
    }
}