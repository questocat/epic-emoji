<?php

namespace Emanci\EpicEmoji\Devices;

class Unified extends AbstractDevice
{
    use DocomoTrait, GoogleTrait, KddiTrait, SoftbankTrait;
}
