<?php

namespace Emanci\EpicEmoji\Devices;

trait DocomoTrait
{
    public function docomo()
    {
        return $this->deviceExchange('docomo');
    }
}
