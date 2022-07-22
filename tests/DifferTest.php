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

    public function testGenDiff(string $expected, string $pathToFirstFile, string $pathToSecondFile, string $formatType = 'stylish')
    {
        $this->assertEquals(file_get_contents($expected), genDiff($pathToFirstFile, $pathToSecondFile, $formatType));
    }

    public function additionProvider(): array
    {
        $stylishFormat = 'stylish';
        $plainFormat = 'plain';
        $jsonFormat = 'json';

        $expectedStylish = $this->getFixturePath("expectedStylish");
        $expectedPlain = $this->getFixturePath("expectedPlain");
        $expectedJson = $this->getFixturePath("expectedJson");
        $pathToFirstFileJson = $this->getFixturePath('file1.json');
        $pathToSecondFileJson = $this->getFixturePath('file2.json');
        $pathToFirstFileYaml = $this->getFixturePath('file1.yaml');
        $pathToSecondFileYaml = $this->getFixturePath('file2.yaml');

        return [
            [$expectedStylish, $pathToFirstFileJson, $pathToSecondFileJson],
            [$expectedStylish, $pathToFirstFileYaml, $pathToSecondFileYaml],
            [$expectedStylish, $pathToFirstFileJson, $pathToSecondFileJson, $stylishFormat],
            [$expectedStylish, $pathToFirstFileYaml, $pathToSecondFileYaml, $stylishFormat],
            [$expectedPlain, $pathToFirstFileJson, $pathToSecondFileJson, $plainFormat],
            [$expectedPlain, $pathToFirstFileYaml, $pathToSecondFileYaml, $plainFormat],
            [$expectedJson, $pathToFirstFileJson, $pathToSecondFileJson, $jsonFormat],
            [$expectedJson, $pathToFirstFileYaml, $pathToSecondFileYaml, $jsonFormat],
        ];
    }
}
