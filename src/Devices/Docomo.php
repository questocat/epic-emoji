<?php

namespace Emanci\EpicEmoji\Devices;

class Docomo extends AbstractDevice
{
    use GoogleTrait, KddiTrait, SoftbankTrait, UnifiedTrait;

    /**
     * {@inheritdoc}
     */
    protected function dynamicWithDictName()
    {
        $this->dict->setAttribute('unicode', 'emoji_docomo');
        $this->dict->setAttribute('html', 'images16/docomo_html');
    }
}
