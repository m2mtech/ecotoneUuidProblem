<?php

namespace src;

use Ecotone\Messaging\Attribute\ServiceContext;
use Ecotone\SymfonyBundle\Config\SymfonyConnectionReference;

class EcotoneConfiguration
{
    #[ServiceContext]
    public function dbalConfiguration(): SymfonyConnectionReference
    {
        return SymfonyConnectionReference::defaultManagerRegistry('default');
    }
}