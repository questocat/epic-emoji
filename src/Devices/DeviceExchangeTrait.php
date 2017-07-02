<?php

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
