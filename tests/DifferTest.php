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
        $expected = file_get_contents(__DIR__ . '/fixtures/expected');
        $this->assertEquals($expected, genDiff($firstFile, $secondFile));
    }
}
