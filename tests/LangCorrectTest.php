<?php

declare(strict_types=1);

namespace B1rdex\Text\Tests;

use B1rdex\Text\LangCorrect;
use PHPUnit\Framework\TestCase;

/**
 * @covers \B1rdex\Text\LangCorrect
 */
class LangCorrectTest extends TestCase
{
    /**
     * @test
     * @dataProvider replaces()
     *
     * @param string $incorrect
     * @param string $expected
     * @param int    $mode
     */
    public function it_should_work(string $incorrect, string $expected, int $mode = LangCorrect::KEYBOARD_LAYOUT)
    {
        $lang = new LangCorrect();
        $result = $lang->parse($incorrect, LangCorrect::KEYBOARD_LAYOUT);

        self::assertEquals($expected, $result);
    }

    public function replaces(): array
    {
        return [
            ['ghbdtn', 'привет'],
            ['руддщ', 'hello'],
            [';tycrbq h.rpfr', 'женский рюкзак'],
            ['cevrf', 'сумка'],
            ['cevrb', 'сумки'],
            ['orb', 'orb'],
            ['zorb', 'zorb'],
            ['surf', 'surf'],
        ];
    }

    /**
     * @test
     */
    public function it_should_skip_some(): void
    {
        $sut = new LangCorrect();
        $result = $sut->parse('блэкаут', LangCorrect::KEYBOARD_LAYOUT);

        self::assertEquals('блэкаут', $result);
    }

    public function testSimpleFixer(): void
    {
        $sut = new LangCorrect();
        $result = $sut->parse('тестo', LangCorrect::SIMILAR_CHARS);

        self::assertEquals('тесто', $result);
    }

    public function testRefs(): void
    {
        $sut = new LangCorrect();
        $phrase = 'Торшер напольный телескопический "Эко-стиль" Е27 60W чёрный гибкие рожки 177х22х22 см';
        $result = $sut->parse($phrase, LangCorrect::KEYBOARD_LAYOUT);

        self::assertNotFalse($result);
    }
}
