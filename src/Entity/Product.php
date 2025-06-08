<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;

class Product
{
    private ?Uuid $productId = null;
    private ?string $name = null;

    public function getProductId(): ?Uuid
    {
        return $this->productId;
    }

    public function setProductId(?Uuid $productId): static
    {
        $this->productId = $productId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }



}