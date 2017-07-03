<?php

/*
 * This file is part of Epic Emoji.
 *
 * (c) emanci <zhengchaopu@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tests;

use Emanci\EpicEmoji\Devices\Google;
use Emanci\EpicEmoji\Devices\Softbank as SoftbankDevice;
use Emanci\EpicEmoji\Devices\Unified;
use Emanci\EpicEmoji\EpicEmoji;

class GoogleTest extends TestCase
{
    protected $google;

    public function setUp()
    {
        $epicEmoji = new EpicEmoji();
        $this->google = $epicEmoji->google();
    }

    public function testConvertUnified()
    {
        $unified = $this->google->unified();
        $this->assertInstanceOf(get_class($unified), new Unified());
    }

    public function testShorthand()
    {
        $poo = emoji_utf8_bytes(0xFE4F4);      // shorthand: hankey, google: 0xFE4F4
        $cloud = emoji_utf8_bytes(0xFE001);     // shorthand: cloud, google: 0xFE001
        $victory = emoji_utf8_bytes(0xFEB94);   // shorthand: v, google: 0xFEB94

        $text = "I like to store my {$poo} in the {$cloud} it makes me feel {$victory}.";

        $this->google->withText($text);
        $this->assertSame('I like to store my :hankey: in the :cloud: it makes me feel :v:.', $this->google->shorthand());
    }

    /**
     * @expectedException        \Emanci\EpicEmoji\FileNotFoundException
     * @expectedExceptionMessage does not exist
     */
    public function testEmojiWasCalledException()
    {
        $unknowDict = new UnknowDict();
        $unknowDict->html();
    }

    public function testDeviceExchangeException()
    {
        $this->setExpectedException('InvalidArgumentException', "doesn't exist.");
        $unknowDevice = new Softbank();
        $unknowDevice->softbank();
    }
}

class UnknowDict extends SoftbankDevice
{
    public function html()
    {
        $htmlDict = $this->getDictionary()->htmlDict('unknow_dict');

        return $this->dictWasCalled($htmlDict, function ($map) {
            $search = array_keys($map);

            return $this->convert($search, $map, $this->text);
        });
    }
}

class Softbank extends SoftbankDevice
{
    public function softbank()
    {
        return $this->deviceExchange('unknowDevice');
    }
}
