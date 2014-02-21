<?php

namespace TheFireflies\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TheFirefliesUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
