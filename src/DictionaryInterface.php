<?php

namespace Emanci\EpicEmoji;

interface DictionaryInterface
{
    /**
     * Returns the name of the shorthand dictionary.
     *
     * @param string|null $name
     *
     * @return string
     */
    public function shorthandDict($name = null);

    /**
     * Returns the name of the unicode dictionary.
     *
     * @param string $name
     *
     * @return string
     */
    public function unicodeDict($name);

    /**
     * Returns the name of the html dictionary.
     *
     * @param string $name
     *
     * @return string
     */
    public function htmlDict($name);
}
