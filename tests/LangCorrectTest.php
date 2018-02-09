<?php

declare(strict_types=1);

namespace Text\Tests;

use PHPUnit\Framework\TestCase;
use Text\LangCorrect;

/**
 * @covers \Text\LangCorrect
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

    public function replaces()
    {
        return [
            ['ghbdtn', 'привет'],
            ['руддщ', 'hello'],
            [';tycrbq h.rpfr', 'женский рюкзак'],
        ];
    }
}
