<?php

namespace Emanci\EpicEmoji\Devices;

trait KddiTrait
{
    public function kddi()
    {
        return $this->deviceExchange('kddi');
    }
}
