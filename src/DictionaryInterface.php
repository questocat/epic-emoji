<?php

namespace Emanci\EpicEmoji;

interface DictionaryInterface
{
    /**
     * Returns the name of the shorthand dictionary.
     *
     * @param string|null $name
     *
     * @return array
     */
    public function shorthandDict($name = null);

    /**
     * Returns the name of the unicode dictionary.
     *
     * @param string $name
     *
     * @return array
     */
    public function unicodeDict($name);

    /**
     * Returns the name of the html dictionary.
     *
     * @param string $name
     *
     * @return array
     */
    public function htmlDict($name);
}
