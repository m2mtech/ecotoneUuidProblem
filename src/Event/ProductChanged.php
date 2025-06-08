<?php

namespace App\Event;

class ProductChanged
{
    public function __construct(public string $productId, public string $name)
    {
    }
}