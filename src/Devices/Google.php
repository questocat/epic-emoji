<?php

namespace Emanci\EpicEmoji\Devices;

class Google extends AbstractDevice
{
    use DocomoTrait, KddiTrait, SoftbankTrait, UnifiedTrait;

    /**
     * {@inheritdoc}
     */
    protected function dynamicWithDictName()
    {
        $this->dict->setAttribute('unicode', 'emoji_google');
        $this->dict->setAttribute('html', 'images16/google_html');
    }
}
