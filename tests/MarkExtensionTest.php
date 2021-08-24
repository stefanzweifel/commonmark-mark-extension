<?php

declare(strict_types=1);

namespace Wnx\CommonmarkMarkExtension\Tests;

use League\CommonMark\CommonMarkConverter;
use PHPUnit\Framework\TestCase;
use Wnx\CommonmarkMarkExtension\MarkExtension;

class MarkExtensionTest extends TestCase
{
    public function getParser($character = '='): CommonMarkConverter
    {
        $converter = new CommonMarkConverter([
            'mark' => [
                'character' => $character,
            ],
        ]);
        $converter
            ->getEnvironment()
            ->addExtension(new MarkExtension());

        return $converter;
    }

    /**
     * @dataProvider getSourceAndExpectedOutputs
     * @param $source
     * @param $expected
     * @param $character
     */
    public function test(string $source, string $expected, string $character): void
    {
        $parser = $this->getParser($character);

        $this->assertEquals(
            $expected . PHP_EOL,
            $parser->convertToHtml($source),
            'Parser generated unexpected output for: "' . $source . '"'
        );
    }

    public function getSourceAndExpectedOutputs(): array
    {
        return [
            'simple_with_equal_signs' => [
                'Hello ==World==',
                '<p>Hello <mark>World</mark></p>',
                '=',
            ],
            'simple_with_colon' => [
                'Hello ::World::',
                '<p>Hello <mark>World</mark></p>',
                ':',
            ],
            'three_equal_signs' => [
                'Hello ===World===',
                '<p>Hello ===World===</p>',
                '=',
            ],
            'three_and_two_equal_signs' => [
                'Hello ===World==',
                '<p>Hello ===World==</p>',
                '=',
            ],
            'two_and_three_equal_signs' => [
                'Hello ==World===',
                '<p>Hello ==World===</p>',
                '=',
            ],
            'three_colons' => [
                'Hello :::World:::',
                '<p>Hello :::World:::</p>',
                ':',
            ],
            'three_and_two_colons' => [
                'Hello :::World::',
                '<p>Hello :::World::</p>',
                ':',
            ],
            'two_and_three_colons' => [
                'Hello ::World:::',
                '<p>Hello ::World:::</p>',
                ':',
            ],
            'mixed_characters_colon' => [
                'Hello ::World==',
                '<p>Hello ::World==</p>',
                ':',
            ],
            'mixed_characters_equal_sign' => [
                'Hello ::World==',
                '<p>Hello ::World==</p>',
                '=',
            ],
            'single_equal_sign' => [
                'Hello =World=',
                '<p>Hello =World=</p>',
                '=',
            ],
            'single_colon' => [
                'Hello :World:',
                '<p>Hello :World:</p>',
                ':',
            ],
        ];
    }
}
