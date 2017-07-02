<?php

namespace Emanci\EpicEmoji\Devices;

trait UnifiedTrait
{
	use DeviceExchangeTrait;
	
    public function unified()
    {
        return $this->deviceExchange('unified');
    }
}
