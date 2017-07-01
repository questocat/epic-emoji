<?php

namespace Tests;

use Emanci\EpicEmoji\EpicEmoji;

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
