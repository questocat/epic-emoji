<?php

namespace Emanci\EpicEmoji\Devices;

class Google extends AbstractDevice
{
    use DoCoMoTrait, KDDITrait, SoftbankTrait, UnifiedTrait;

    /**
     * {@inheritdoc}
     */
    public function dynamicWithDictName()
    {
        $this->dict->setAttribute('unicode', 'emoji_google');
        $this->dict->setAttribute('html', 'images16/google_html');
    }
}
