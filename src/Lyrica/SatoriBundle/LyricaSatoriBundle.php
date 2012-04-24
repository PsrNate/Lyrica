<?php

namespace Lyrica\SatoriBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LyricaSatoriBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
