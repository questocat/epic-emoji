<?php

/*
 * This file is part of questocat/epic-emoji package.
 *
 * (c) questocat <zhengchaopu@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Questocat\EpicEmoji\Devices;

use Questocat\EpicEmoji\Dictionary;
use Questocat\EpicEmoji\DictionaryInterface;
use InvalidArgumentException;

/**
 * 提示: emoji 表情有很多种版本, 其中包括Unified, DoCoMo, KDDI, Softbank和Google, 并且不同版本用于表示同一符号表情的 unicode 代码也不相同.
 */
abstract class AbstractDevice
{
    /**
     * The input text.
     *
     * @var string
     */
    protected $text;

    /**
     * The dictionary instance.
     *
     * @var DictionaryInterface
     */
    protected $dict;

    /**
     * The shorthand dict name.
     *
     * @var string
     */
    protected $shorthand = 'shorthand';

    /**
     * Unique device Identifier.
     *
     * @var string
     */
    protected $deviceIdentifier;

    /**
     * AbstractUnicode construct.
     *
     * @param string $text
     */
    public function __construct($text = null)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->text;
    }

    /**
     * Set the text.
     *
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Set the text.
     *
     * @param string $text
     */
    public function withText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Set the dictionary.
     */
    public function setDictionary(DictionaryInterface $dict)
    {
        $this->dict = $dict;

        return $this;
    }

    /**
     * Returns the dictionary.
     *
     * @return DictionaryInterface
     */
    public function getDictionary()
    {
        if (is_null($this->dict)) {
            $path = dirname(dirname(__DIR__)).'/data/';
            $this->dict = new Dictionary($path);
        }

        return $this->dict;
    }

    /**
     * Output emoji.
     *
     * @return string
     */
    public function emoji()
    {
        return $this->text;
    }

    /**
     * Returns shorthand of the text.
     *
     * @return string
     */
    public function shorthand()
    {
        $shorthandDict = $this->getDictionary()->shorthandDict($this->shorthand);
        $search = array_column($shorthandDict, $this->getDeviceIdentifier());
        $replace = array_keys($shorthandDict);

        return $this->convert($this->text, $search, $replace);
    }

    /**
     * Returns codepoint of the unicode.
     *
     * @return string
     */
    public function codepoint()
    {
        $unicodeDict = $this->getUnicodeDict();
        $search = array_keys($unicodeDict);
        $replace = array_column($unicodeDict, 'codepoint');

        return $this->convert($this->text, $search, $replace);
    }

    /**
     * Converts to HTML.
     *
     * @return string
     */
    public function html()
    {
        $calledDevice = $this->getDeviceIdentifier();
        $dictionary = $this->getDictionary()->htmlDict($calledDevice);

        return strtr($this->text, $dictionary);
    }

    /**
     * Converts to HTML entities.
     *
     * @return string
     */
    public function htmlEntity()
    {
        $unicodeDict = $this->getUnicodeDict();
        $search = array_keys($unicodeDict);
        $replace = array_map(function ($codepoint) {
            return html_entity($codepoint);
        }, array_column($unicodeDict, 'codepoint'));

        return $this->convert($this->text, $search, $replace);
    }

    /**
     * Converts to target device.
     *
     * @param string $device
     *
     * @throws InvalidArgumentException
     *
     * @return mixed
     */
    protected function deviceExchange($device)
    {
        $unicodeDict = $this->getUnicodeDict();
        $deviceName = __NAMESPACE__.'\\'.ucfirst($device);

        if (!class_exists($deviceName)) {
            throw new InvalidArgumentException("Device [$deviceName] doesn't exist.");
        }

        $search = array_keys($unicodeDict);
        $replace = array_column(array_column($unicodeDict, 'unicode'), strtolower($device));
        $replacement = $this->convert($this->text, $search, $replace);

        return new $deviceName($replacement);
    }

    /**
     * Converts text.
     *
     * @param string $text
     * @param mixed  $search
     * @param mixed  $replace
     *
     * @return string
     */
    protected function convert($text, $search, $replace)
    {
        return str_replace($search, $replace, $text);
    }

    /**
     * Returns the device Identifier.
     *
     * @return string
     */
    protected function getDeviceIdentifier()
    {
        return $this->deviceIdentifier;
    }

    /**
     * Get the unicode dictionart dict.
     *
     * @return array
     */
    protected function getUnicodeDict()
    {
        $calledDevice = $this->getDeviceIdentifier();

        return $this->getDictionary()->unicodeDict($calledDevice);
    }
}
