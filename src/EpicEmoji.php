<?php

/*
 * This file is part of Epic Emoji.
 *
 * (c) emanci <zhengchaopu@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Emanci\EpicEmoji;

use Emanci\EpicEmoji\Devices\AbstractDevice;
use InvalidArgumentException;

class EpicEmoji
{
    /**
     * The array of created devices.
     *
     * @var array
     */
    protected $devices = [];

    /**
     * The initial devices.
     *
     * @var array
     */
    protected $initialUnicode = [
        'unified' => 'Unified',
        'softbank' => 'Softbank',
        'kddi' => 'KDDI',
        'google' => 'Google',
        'docomo' => 'DoCoMo',
    ];

    /**
     * @param string $name
     * @param string $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (!isset($this->devices[$name])) {
            $text = implode('', $arguments);
            $this->devices[$name] = $this->createDevice($name, $text);
        }

        return $this->devices[$name];
    }

    /**
     * Create a new devices instance.
     *
     * @param string $device
     * @param string $text
     *
     * @return mixed
     */
    protected function createDevice($device, $text)
    {
        if (isset($this->initialUnicode[$device])) {
            $device = ucfirst($device);
            $deviceClass = __NAMESPACE__.'\\Devices\\'.$device;

            return $this->buildDevice($deviceClass, $text);
        }

        throw new InvalidArgumentException("Devices [$device] not supported.");
    }

    /**
     * Build a device instance.
     *
     * @param string $device
     * @param string $text
     *
     * @return AbstractDevice
     */
    protected function buildDevice($device, $text)
    {
        return new $device($text);
    }
}
