<?php

namespace App\Command;

class CreateProductCommand
{
    public function __construct(public string $productId, public string $name)
    {
    }
}