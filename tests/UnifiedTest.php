<?php

namespace Tests;

use Emanci\EpicEmoji\Devices\DoCoMo;
use Emanci\EpicEmoji\Devices\Google;
use Emanci\EpicEmoji\Devices\KDDI;
use Emanci\EpicEmoji\Devices\Softbank;
use Emanci\EpicEmoji\Devices\Unified;

class UnifiedTest extends TestCase
{
    protected $unified;

    protected $text;

    public function setUp()
    {
        $poo = emoji_utf8_bytes(0x1F4A9);      // shorthand: hankey, softbank: 0xE05A
        $cloud = emoji_utf8_bytes(0x2601);     // shorthand: cloud, softbank: 0xE049
        $victory = emoji_utf8_bytes(0x270C);   // shorthand: v, softbank: 0xE011

        $this->text = "I like to store my {$poo} in the {$cloud} it makes me feel {$victory}.";
        $this->unified = new Unified($this->text);
    }

    public function testEmoji()
    {
        $this->assertEquals($this->text, $this->unified->emoji());
        $this->unified->setText('好害羞');
        $this->assertSame('好害羞', $this->unified->emoji());
        $this->unified->withText('再来一把');
        $this->assertSame('再来一把', $this->unified->emoji());
    }

    public function testShorthand()
    {
        $text = 'I like to store my :hankey: in the :cloud: it makes me feel :v:.';
        $this->assertEquals($text, $this->unified->shorthand());
    }

    public function testCodepoint()
    {
        $text = 'I like to store my U+1F4A9 in the U+2601 it makes me feel U+270C.';
        $this->assertEquals($text, $this->unified->codepoint());
    }

    public function testHtmlEntity()
    {
        $text = 'I like to store my '.html_entity('1F4A9').' in the '.html_entity('2601').' it makes me feel '.html_entity('270C').'.';
        $this->assertEquals($text, $this->unified->htmlEntity());
    }

    public function testConvertSoftbank()
    {
        $softbank = $this->unified->softbank();
        $this->assertInstanceOf(get_class($softbank), new Softbank());

        $softbankDevice = new SoftbankDevice();
        $this->assertEquals($softbank->emoji(), $softbankDevice->emoji());
        $this->assertEquals($softbank->shorthand(), $softbankDevice->shorthand());
    }

    public function testConvertKDDI()
    {
        $kddi = $this->unified->kddi();
        $this->assertInstanceOf(get_class($kddi), new KDDI());
    }

    public function testConvertGoogle()
    {
        $google = $this->unified->google();
        $this->assertInstanceOf(get_class($google), new Google());
    }

    public function testConvertDoCoMo()
    {
        $docomo = $this->unified->docomo();
        $this->assertInstanceOf(get_class($docomo), new DoCoMo());
    }
}

class SoftbankDevice extends Softbank
{
    public function emoji()
    {
        $poo = emoji_utf8_bytes(0xE05A);       // shorthand: hankey, softbank: 0xE05A
        $cloud = emoji_utf8_bytes(0xE049);     // shorthand: cloud, softbank: 0xE049
        $victory = emoji_utf8_bytes(0xE011);   // shorthand: v, softbank: 0xE011

        return "I like to store my {$poo} in the {$cloud} it makes me feel {$victory}.";
    }

    public function shorthand()
    {
        return 'I like to store my :hankey: in the :cloud: it makes me feel :v:.';
    }
}
