<?php

namespace Emanci\EpicEmoji;

interface DictionaryInterface
{
    /**
     * Returns the name of shorthand dictionary.
     *
     * @return string
     */
    public function shorthandDictName();

    /**
     * Returns the name of unicode dictionary.
     *
     * @return string
     */
    public function unicodeDictName();

    /**
     * Returns the name of html dictionary.
     *
     * @return string
     */
    public function htmlDictName();
}
