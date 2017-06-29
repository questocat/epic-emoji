<?php

namespace Emanci\EpicEmoji\Devices;

trait GoogleTrait
{
    public function google()
    {
        return $this->deviceExchange('Google');
    }
}
