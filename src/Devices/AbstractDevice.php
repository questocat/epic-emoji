<?php

namespace Emanci\EpicEmoji\Devices;

use Emanci\EpicEmoji\Dictionary;
use Emanci\EpicEmoji\DictionaryInterface;
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
     * AbstractUnicode construct.
     *
     * @param string $text
     */
    public function __construct($text = null)
    {
        $this->text = $text;
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
     * Returns shorthand of text.
     *
     * @return string
     */
    public function shorthand()
    {
        $shorthandDict = $this->getDictionary()->shorthandDict();

        return $this->dictWasCalled($shorthandDict, function ($map) {
            $device = $this->getCalledDevices();
            $search = array_column($map, $device);
            $replace = array_keys($map);

            return $this->convert($search, $replace, $this->text);
        });
    }

    /**
     * Returns codepoint of unicode.
     *
     * @return string
     */
    public function codepoint()
    {
        $unicodeDict = $this->getUnicodeDict();

        return $this->dictWasCalled($unicodeDict, function ($map) {
            $search = array_keys($map);
            $replace = array_column($map, 'codepoint');

            return $this->convert($search, $replace, $this->text);
        });
    }

    /**
     * Converts to HTML.
     *
     * @return string
     */
    public function html()
    {
        $calledDevice = $this->getCalledDevices();
        $htmlDict = $this->getDictionary()->htmlDict($calledDevice);

        return $this->dictWasCalled($htmlDict, function ($map) {
            $search = array_keys($map);

            return $this->convert($search, $map, $this->text);
        });
    }

    /**
     * Converts to HTML entities.
     *
     * @return string
     */
    public function htmlEntity()
    {
        $unicodeDict = $this->getUnicodeDict();

        return $this->dictWasCalled($unicodeDict, function ($map) {
            $search = array_keys($map);
            $replace = array_map(function ($codepoint) {
                return html_entity($codepoint);
            }, array_column($map, 'codepoint'));

            return $this->convert($search, $replace, $this->text);
        });
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

        return $this->dictWasCalled($unicodeDict, function ($map) use ($device) {
            $deviceName = __NAMESPACE__.'\\'.ucfirst($device);

            if (!class_exists($deviceName)) {
                throw new InvalidArgumentException("Device [$deviceName] doesn't exist.");
            }

            $search = array_keys($map);
            $replace = array_column(array_column($map, 'unicode'), strtolower($device));
            $replacement = $this->convert($search, $replace, $this->text);

            return new $deviceName($replacement);
        });
    }

    /**
     * Converts text.
     *
     * @param mixed  $search
     * @param mixed  $replace
     * @param string $text
     *
     * @return mixed
     */
    protected function convert($search, $replace, $text)
    {
        return str_replace($search, $replace, $text);
    }

    /**
     * Returns the called devices.
     *
     * @return string
     */
    protected function getCalledDevices()
    {
        $classArr = explode('\\', get_class($this));

        return strtolower(array_pop($classArr));
    }

    /**
     * Get the unicode dictionart dict.
     *
     * @return array
     */
    protected function getUnicodeDict()
    {
        $calledDevice = $this->getCalledDevices();

        return $this->getDictionary()->unicodeDict($calledDevice);
    }

    /**
     * @param array    $dict
     * @param callable $callback
     *
     * @return mixed
     */
    protected function dictWasCalled(array $dict, callable $callback)
    {
        return map($dict, $callback);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->text;
    }
}
