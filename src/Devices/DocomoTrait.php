<?php

/*
 * This file is part of questocat/epic-emoji package.
 *
 * (c) questocat <zhengchaopu@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Questocat\EpicEmoji\Devices;

trait DocomoTrait
{
    use DeviceExchangeTrait;

    public function docomo()
    {
        return $this->deviceExchange('docomo');
    }
}
