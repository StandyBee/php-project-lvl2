<?php

namespace Differ\Tests;

use Exception;
use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function getFixturePath(string $fileName): string
    {
        return __DIR__ . '/fixtures/' . $fileName;
    }

    /**
     * @dataProvider additionProvider
     */
    public function testGenDiffYamlFormat($format): void
    {
        $expected = __DIR__ . "/fixtures/expectedStylish";
        $pathToFirstFile = __DIR__ . "/fixtures/file1.{$format}";
        $pathToSecondFile = __DIR__ . "/fixtures/file2.{$format}";

        $this->assertStringEqualsFile($expected, genDiff($pathToFirstFile, $pathToSecondFile));
    }

    /**
     * @dataProvider additionProvider
     */    
    public function testGenDiffJsonFormat($format): void
    {
        $expected = __DIR__ . "/fixtures/expectedStylish";
        $pathToFirstFile = __DIR__ . "/fixtures/file1.{$format}";
        $pathToSecondFile = __DIR__ . "/fixtures/file2.{$format}";
        $this->assertStringEqualsFile($expected, genDiff($pathToFirstFile, $pathToSecondFile, 'stylish'));
    }

    /**
     * @dataProvider additionProvider
     */
    public function testGenDiffPlain($format): void
    {
        $expected = __DIR__ . "/fixtures/expectedPlain";
        $pathToFirstFile = __DIR__ . "/fixtures/file1.{$format}";
        $pathToSecondFile = __DIR__ . "/fixtures/file2.{$format}";
        $this->assertStringEqualsFile($expected, genDiff($pathToFirstFile, $pathToSecondFile, "plain"));
    }

    /**
     * @dataProvider additionProvider
     */
    public function testGenDiffJson($format): void
    {
        $expected = file_get_contents(__DIR__ . "/fixtures/expectedJson");
        $pathToFirstFile = __DIR__ . "/fixtures/file1.{$format}";
        $pathToSecondFile = __DIR__ . "/fixtures/file2.{$format}";
        $this->assertEquals($expected, genDiff($pathToFirstFile, $pathToSecondFile, "json"));
    }

    public function additionProvider(): array
    {
        return [
            ['json'],
            ['yaml']
        ];
    }
}
