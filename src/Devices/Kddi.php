<?php

namespace Emanci\EpicEmoji\Devices;

class Kddi extends AbstractDevice
{
    use DocomoTrait, GoogleTrait, SoftbankTrait, UnifiedTrait;

    /**
     * {@inheritdoc}
     */
    public function dynamicWithDictName()
    {
        $this->dict->setAttribute('unicode', 'emoji_kddi');
        $this->dict->setAttribute('html', 'images16/kddi_html');
    }
}
