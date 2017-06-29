<?php

namespace Emanci\EpicEmoji;

trait HasAttributes
{
    /**
     * The attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Set a given attribute.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Get an attribute by key.
     *
     * @param mixed $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function getAttribute($key, $default = null)
    {
        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }

        return $default;
    }

    /**
     * Get all of the current attributes.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}
