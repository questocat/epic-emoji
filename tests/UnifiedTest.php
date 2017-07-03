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

use Emanci\EpicEmoji\Devices\Docomo;
use Emanci\EpicEmoji\Devices\Google;
use Emanci\EpicEmoji\Devices\Kddi;
use Emanci\EpicEmoji\Devices\Softbank as SoftbankDevice;
use Emanci\EpicEmoji\Devices\Unified;
use Emanci\EpicEmoji\DictionaryInterface;
use Emanci\EpicEmoji\EpicEmoji;

class UnifiedTest extends TestCase
{
    protected $unified;

    protected $dict;

    public function setUp()
    {
        $epicEmoji = new EpicEmoji();
        $text = 'I like to store my aaa in the fff it makes me feel kkk.';
        $this->unified = $epicEmoji->unified($text);

        $this->dict = new MockDict();
        $this->unified->setDictionary($this->dict);
    }

    public function testDictionary()
    {
        $this->assertSame($this->dict, $this->unified->getDictionary());
    }

    public function testEmoji()
    {
        $this->assertEquals('I like to store my aaa in the fff it makes me feel kkk.', $this->unified->emoji());
        $this->unified->setText('好害羞');
        $this->assertSame('好害羞', $this->unified->emoji());
        $this->unified->withText('再来一把');
        $this->assertSame('再来一把', $this->unified->emoji());
    }

    public function testToString()
    {
        $this->unified->setText('foo bar');
        $this->assertSame('foo bar', (string) $this->unified);
    }

    public function testShorthand()
    {
        $text = 'I like to store my :hankey: in the :cloud: it makes me feel :v:.';
        $this->assertSame($text, $this->unified->shorthand());
    }

    public function testCodepoint()
    {
        $text = 'I like to store my U+111 in the U+222 it makes me feel U+333.';
        $this->assertSame($text, $this->unified->codepoint());
    }

    public function testHtmlEntity()
    {
        $text = 'I like to store my '.html_entity('111').' in the '.html_entity('222').' it makes me feel '.html_entity('333').'.';
        $this->assertSame($text, $this->unified->htmlEntity());
    }

    public function testHtml()
    {
        $text = 'I like to store my html_aaa in the html_fff it makes me feel html_kkk.';
        $this->assertSame($text, $this->unified->html());
    }

    public function testConvertSoftbank()
    {
        $softbank = $this->unified->softbank();
        $this->assertInstanceOf(get_class($softbank), new SoftbankDevice());
    }

    public function testConvertKDDI()
    {
        $kddi = $this->unified->kddi();
        $this->assertInstanceOf(get_class($kddi), new Kddi());
    }

    public function testConvertGoogle()
    {
        $google = $this->unified->google();
        $this->assertInstanceOf(get_class($google), new Google());
    }

    public function testConvertDoCoMo()
    {
        $docomo = $this->unified->docomo();
        $this->assertInstanceOf(get_class($docomo), new Docomo());
    }
}

class MockDict implements DictionaryInterface
{
    /**
     * Returns the name of shorthand dictionary.
     *
     * @param string|null $name
     *
     * @return string
     */
    public function shorthandDict($name)
    {
        return [
            ':hankey:' => [
                'unified' => 'aaa',
                'docomo' => 'bbb',
                'softbank' => 'ccc',
                'google' => 'ddd',
                'kddi' => 'eee',
            ],
            ':cloud:' => [
                'unified' => 'fff',
                'docomo' => 'ggg',
                'softbank' => 'hhh',
                'google' => 'iii',
                'kddi' => 'jjj',
            ],
            ':v:' => [
                'unified' => 'kkk',
                'docomo' => 'mmm',
                'softbank' => 'nnn',
                'google' => 'ppp',
                'kddi' => 'qqq',
            ],
        ];
    }

    /**
     * Returns the name of unicode dictionary.
     *
     * @param string $name
     *
     * @return string
     */
    public function unicodeDict($name)
    {
        return [
            'aaa' => [
                'codepoint' => 'U+111',
                'unicode' => [
                    'docomo' => 'bbb',
                    'softbank' => 'ccc',
                    'google' => 'ddd',
                    'kddi' => 'eee',
                ],
            ],
            'fff' => [
                'codepoint' => 'U+222',
                'unicode' => [
                    'docomo' => 'ggg',
                    'softbank' => 'hhh',
                    'google' => 'iii',
                    'kddi' => 'jjj',
                ],
            ],
            'kkk' => [
                'codepoint' => 'U+333',
                'unicode' => [
                    'docomo' => 'mmm',
                    'softbank' => 'nnn',
                    'google' => 'ppp',
                    'kddi' => 'qqq',
                ],
            ],
        ];
    }

    /**
     * Returns the name of html dictionary.
     *
     * @param string $name
     *
     * @return string
     */
    public function htmlDict($name)
    {
        return [
            'aaa' => 'html_aaa',
            'fff' => 'html_fff',
            'kkk' => 'html_kkk',
        ];
    }
}
