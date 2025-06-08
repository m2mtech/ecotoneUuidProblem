<?php

namespace App\Command;

use App\Entity\Product;

class ChangeProductCommand
{
    public function __construct(public string $productId, public Product $product)
    {
    }
}