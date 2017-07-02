<?php
/**
 * @author: emanci <zhengchaopu@gmail.com>
 *
 * @copyright 2017 moerlong.com
 */

namespace Emanci\EpicEmoji\Devices;

trait DeviceExchangeTrait
{
    /**
     * Converts to target device.
     *
     * @param string $device
     *
     * @return mixed
     */
    abstract protected function deviceExchange($device);
}
