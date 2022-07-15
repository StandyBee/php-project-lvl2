<?php

namespace Differ\Tests;

use Exception;
use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testGenDiffJson()
    {
        $firstFile = __DIR__ . '/fixtures/file1.json';
        $secondFile = __DIR__ . '/fixtures/file2.json';
        $expected = file_get_contents(__DIR__ . '/fixtures/expectedStylish');
        $this->assertEquals($expected, genDiff($firstFile, $secondFile));
    }
    
    public function testGenDiffYaml()
    {
        $firstFile = __DIR__ . '/fixtures/file1.yaml';
        $secondFile = __DIR__ . '/fixtures/file2.yaml';
        $expected = file_get_contents(__DIR__ . '/fixtures/expectedStylish');
        $this->assertEquals($expected, genDiff($firstFile, $secondFile));
    }

    public function testGenDiffComplexYaml()
    {
        $firstFile = __DIR__ . '/fixtures/file1Complex.yaml';
        $secondFile = __DIR__ . '/fixtures/file2Complex.yaml';
        $expected = file_get_contents(__DIR__ . '/fixtures/expectedStylishComplex');
        $this->assertEquals($expected, genDiff($firstFile, $secondFile));
    }

    public function testGenDiffComplexJson()
    {
        $firstFile = __DIR__ . '/fixtures/file1Complex.json';
        $secondFile = __DIR__ . '/fixtures/file2Complex.json';
        $expected = file_get_contents(__DIR__ . '/fixtures/expectedStylishComplex');
        $this->assertEquals($expected, genDiff($firstFile, $secondFile));
    }
    
    public function testGenDiffPlain()
    {
        $firstFile = __DIR__ . '/fixtures/file1Complex.json';
        $secondFile = __DIR__ . '/fixtures/file2Complex.json';
        $expected = file_get_contents(__DIR__ . '/fixtures/expectedPlain');
        $this->assertEquals($expected, genDiff($firstFile, $secondFile, $formatType = 'plain'));
    }
}
