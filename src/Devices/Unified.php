<?php

namespace Emanci\EpicEmoji\Devices;

class Unified extends AbstractDevice
{
    use DoCoMoTrait, GoogleTrait, KDDITrait, SoftbankTrait;

    /**
     * {@inheritdoc}
     */
    public function dynamicWithDictName()
    {
        $this->dict->setAttribute('unicode', 'emoji_unified');
        $this->dict->setAttribute('html', 'images16/unified_html');
    }
}
