<?php

/*
 * This file is part of questocat/epic-emoji package.
 *
 * (c) questocat <zhengchaopu@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tests;

class HelpersTest extends TestCase
{
    public function testEmojiUtf8Bytes()
    {
        $bytesOne = emoji_utf8_bytes(0x0023);
        $bytesTwo = emoji_utf8_bytes(0x00AE);
        $bytesThree = emoji_utf8_bytes(0x3299);
        $bytesFour = emoji_utf8_bytes(0x26F9).emoji_utf8_bytes(0xFE0F).emoji_utf8_bytes(0x200D).emoji_utf8_bytes(0x2642).emoji_utf8_bytes(0xFE0F);

        $this->assertSame('#', $bytesOne);
        $this->assertSame('®', $bytesTwo);
        $this->assertSame('㊙', $bytesThree);
        $this->assertSame('⛹️‍♂️', $bytesFour);
    }
}
