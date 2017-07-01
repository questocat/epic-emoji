<?php

namespace Emanci\EpicEmoji;

class Dictionary implements DictionaryInterface
{
    /**
     * The dictionary path.
     *
     * @var string
     */
    protected $path;

    /**
     * Dictionary constructor.
     *
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Returns the name of shorthand dictionary.
     *
     * @param string $name
     *
     * @return string
     */
    public function shorthandDict($name = null)
    {
        $name = $name ?: 'shorthand';

        return $this->getDictByName($name);
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
        $name = sprintf('emoji_%s', $name);

        return $this->getDictByName($name);
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
        $name = sprintf('images16/%s_html', $name);

        return $this->getDictByName($name);
    }

    /**
     * Returns the dictionary.
     *
     * @param string $name
     *
     * @throws FileNotFoundException
     *
     * @return array
     */
    protected function getDictByName($name)
    {
        $path = $this->path.'/'.$name;

        if (file_exists($path)) {
            $dict = (array) include $path;

            return $dict;
        }

        throw new FileNotFoundException("Dictionary does not exist at path {$path}");
    }
}
