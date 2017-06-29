<?php

namespace Emanci\EpicEmoji;

class Dictionary implements DictionaryInterface
{
    use HasAttributes;

    /**
     * Dictionary constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Returns the name of shorthand dictionary.
     *
     * @return string
     */
    public function shorthandDictName()
    {
        return $this->getAttribute('shorthand');
    }

    /**
     * Returns the name of unicode dictionary.
     *
     * @return string
     */
    public function unicodeDictName()
    {
        return $this->getAttribute('unicode');
    }

    /**
     * Returns the name of html dictionary.
     *
     * @return string
     */
    public function htmlDictName()
    {
        return $this->getAttribute('html');
    }
}
