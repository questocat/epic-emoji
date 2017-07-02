<?php

namespace Emanci\EpicEmoji\Devices;

trait DocomoTrait
{
    use DeviceExchangeTrait;

    public function docomo()
    {
        return $this->deviceExchange('docomo');
    }
}
