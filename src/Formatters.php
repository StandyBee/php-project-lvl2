<?php

namespace Differ\Formatters;

use function Differ\Formatters\Stylish\formatStylish;
use function Differ\Formatters\Plain\formatPlain;
use function Differ\Formatters\Json\formatJson;

function formatters(array $data, string $format): string
{
    switch ($format) {
        case 'stylish':
            return formatStylish($data);
        case 'plain':
            return formatPlain($data);
        case 'json':
            return formatJson($data);
        default:
            throw new \Exception("unknown format {$format}");
    }
}