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

use Questocat\EpicEmoji\EpicEmoji;

class EpicEmojiTest extends TestCase
{
    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage not supported
     */
    public function testUnknowDevice()
    {
        $epicEmoji = new EpicEmoji();
        $epicEmoji->unknowDevice();
    }
}
