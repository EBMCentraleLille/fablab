<?php

namespace CentraleLille\CustomFosUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CustomFosUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
