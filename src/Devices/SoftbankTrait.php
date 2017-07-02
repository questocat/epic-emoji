<?php

namespace Emanci\EpicEmoji\Devices;

trait SoftbankTrait
{
    use DeviceExchangeTrait;

    public function softbank()
    {
        return $this->deviceExchange('softbank');
    }
}
