<?php

namespace App\Aggregate;

use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\Attribute\EventSourcingAggregate;
use Ecotone\Modelling\Attribute\EventSourcingHandler;
use Ecotone\Modelling\Attribute\Identifier;
use Ecotone\Modelling\WithAggregateVersioning;
use Ecotone\Modelling\WithEvents;
use App\Command\ChangeProductCommand;
use App\Command\CreateProductCommand;
use App\Event\ProductChanged;
use App\Event\ProductCreated;

#[EventSourcingAggregate(true)]
final class Product
{
    use WithEvents;
    use WithAggregateVersioning;

    #[Identifier]
    public string $productId;

    public string $name;

    #[CommandHandler]
    public static function create(CreateProductCommand $command): Product
    {
        $page = new self();
        $page->recordThat(new ProductCreated($command->productId, $command->name));

        return $page;
    }

    #[CommandHandler]
    public function changeProduct(ChangeProductCommand $command) : void
    {
        $this->recordThat(new ProductChanged($command->productId, $command->product->getName()));
    }

    #[EventSourcingHandler]
    public function productChanged(ProductChanged $event): void
    {
        $this->name = $event->name;
    }
}
