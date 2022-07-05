<?php

namespace Differ\Differ;

function genDiff($firstFile, $secondFile)
{
    $file1 = json_decode(file_get_contents($firstFile), true);
    $file2 = json_decode(file_get_contents($secondFile), true);

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

// $a = '{
//     "host": "hexlet.io",
//     "timeout": 50,
//     "proxy": "123.234.53.22",
//     "follow": false
//   }';
// $b = '{
//     "timeout": 20,
//     "verbose": true,
//     "host": "hexlet.io"
//   }';
//   genDiff($a, $b);