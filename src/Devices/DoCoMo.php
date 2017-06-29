<?php

namespace Emanci\EpicEmoji\Devices;

class DoCoMo extends AbstractDevice
{
    use GoogleTrait, KDDITrait, SoftbankTrait, UnifiedTrait;

    /**
     * {@inheritdoc}
     */
    public function dynamicWithDictName()
    {
        $this->dict->setAttribute('unicode', 'emoji_docomo');
        $this->dict->setAttribute('html', 'images16/docomo_html');
    }
}
