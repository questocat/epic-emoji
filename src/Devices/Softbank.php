<?php

namespace Emanci\EpicEmoji\Devices;

class Softbank extends AbstractDevice
{
    use DocomoTrait, GoogleTrait, KddiTrait, UnifiedTrait;
}
