<?php

namespace Emanci\EpicEmoji\Devices;

trait DoCoMoTrait
{
    public function docomo()
    {
        return $this->deviceExchange('docomo');
    }
}
