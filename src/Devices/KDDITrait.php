<?php

namespace Emanci\EpicEmoji\Devices;

trait KDDITrait
{
    public function kddi()
    {
        return $this->deviceExchange('KDDI');
    }
}
