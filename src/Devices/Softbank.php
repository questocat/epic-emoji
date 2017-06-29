<?php

namespace Emanci\EpicEmoji\Devices;

class Softbank extends AbstractDevice
{
    use DoCoMoTrait, GoogleTrait, KDDITrait, UnifiedTrait;

    /**
     * {@inheritdoc}
     */
    public function dynamicWithDictName()
    {
        $this->dict->setAttribute('unicode', 'emoji_softbank');
        $this->dict->setAttribute('html', 'images16/softbank_html');
    }
}
