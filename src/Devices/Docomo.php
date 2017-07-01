<?php

namespace Emanci\EpicEmoji\Devices;

class Docomo extends AbstractDevice
{
    use GoogleTrait, KddiTrait, SoftbankTrait, UnifiedTrait;
}
