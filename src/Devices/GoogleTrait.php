<?php

namespace Emanci\EpicEmoji\Devices;

trait GoogleTrait
{
    use DeviceExchangeTrait;

    public function google()
    {
        return $this->deviceExchange('google');
    }
}
