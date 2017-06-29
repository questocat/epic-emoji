<?php

namespace Emanci\EpicEmoji\Devices;

trait UnifiedTrait
{
    public function unified()
    {
        return $this->deviceExchange('Unified');
    }
}
