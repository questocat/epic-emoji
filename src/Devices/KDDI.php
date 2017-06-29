<?php

namespace Emanci\EpicEmoji\Devices;

class KDDI extends AbstractDevice
{
    use DoCoMoTrait, GoogleTrait, SoftbankTrait, UnifiedTrait;

    /**
     * {@inheritdoc}
     */
    public function dynamicWithDictName()
    {
        $this->dict->setAttribute('unicode', 'emoji_kddi');
        $this->dict->setAttribute('html', 'images16/kddi_html');
    }
}
