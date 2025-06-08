<?php

namespace App\Event;

class ProductCreated
{
    public function __construct(public string $productId, public string $name)
    {
    }
}