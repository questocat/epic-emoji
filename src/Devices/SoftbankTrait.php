<?php

namespace Emanci\EpicEmoji\Devices;

trait SoftbankTrait
{
    public function softbank()
    {
        return $this->deviceExchange('Softbank');
    }
}
