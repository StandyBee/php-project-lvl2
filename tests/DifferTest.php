<?php

namespace Differ\Tests;

use Exception;
use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testGenDiff()
    {
        $firstFile = __DIR__ . '/fixtures/file1.json';
        $secondFile = __DIR__ . '/fixtures/file2.json';
        $expected = file_get_contents(__DIR__ . '/fixtures/expectedJson');
        $this->assertEquals($expected, genDiff($firstFile, $secondFile));
    }
    
    public function testGenDiffYaml()
    {
        $firstFile = __DIR__ . '/fixtures/file1.yaml';
        $secondFile = __DIR__ . '/fixtures/file2.yaml';
        $expected = file_get_contents(__DIR__ . '/fixtures/expectedYaml');
        $this->assertEquals($expected, genDiff($firstFile, $secondFile));
    }
}
