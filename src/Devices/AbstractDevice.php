<?php

namespace Emanci\EpicEmoji\Devices;

use Closure;
use Emanci\EpicEmoji\Dictionary;
use Emanci\EpicEmoji\FileNotFoundException;
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
     * @var Dictionary
     */
    protected $dict;

    /**
     * AbstractUnicode construct.
     *
     * @param string $text
     */
    public function __construct($text = null)
    {
        if (!is_null($text)) {
            $this->text = $text;
        }

        $this->createDictionary();
    }

    /**
     * Dynamically set dictionary name.
     */
    abstract protected function dynamicWithDictName();

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
     * Create the dictionary.
     *
     * @return Dictionary
     */
    protected function createDictionary()
    {
        $default = [
            'shorthand' => 'emoji_shorthand',
        ];

        $this->dict = new Dictionary($default);
        $this->dynamicWithDictName();
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
        $shorthandDictName = $this->dict->shorthandDictName();

        return $this->emojiWasCalled($shorthandDictName, function ($map) {
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
        $unicodeDictName = $this->dict->unicodeDictName();

        return $this->emojiWasCalled($unicodeDictName, function ($map) {
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
        $htmlDictName = $this->dict->htmlDictName();

        return $this->emojiWasCalled($htmlDictName, function ($map) {
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
        $unicodeDictName = $this->dict->unicodeDictName();

        return $this->emojiWasCalled($unicodeDictName, function ($map) {
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
        $unicodeDictName = $this->dict->unicodeDictName();

        return $this->emojiWasCalled($unicodeDictName, function ($map) use ($device) {
            $deviceName = __NAMESPACE__.'\\'.ucfirst($device);

            if (!class_exists($deviceName)) {
                throw new InvalidArgumentException("Device [$deviceName] doesn't exist.");
            }

            $search = array_keys($map);
            $replace = array_column(array_column($map, 'unicode'), $device);
            $replacement = $this->convert($search, $replace, $this->text);

            return new $deviceName($replacement);
        });
    }

    /**
     * Converts text.
     *
     * @param mixed $search
     * @param mixed $replace
     * @param mixed $text
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
     * @param Closure $callback
     *
     * @return mixed
     */
    protected function emojiWasCalled($identifier, Closure $callback)
    {
        $path = dirname(dirname(__DIR__)).'/data/'.$identifier;

        if (file_exists($path)) {
            $emojis = (array) include $path;

            return map($emojis, $callback);
        }

        throw new FileNotFoundException("File does not exist at path {$path}");
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->text;
    }
}
