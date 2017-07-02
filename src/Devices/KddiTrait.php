<?php

namespace Emanci\EpicEmoji\Devices;

trait KddiTrait
{
    use DeviceExchangeTrait;

    public function kddi()
    {
        return $this->deviceExchange('kddi');
    }
}
