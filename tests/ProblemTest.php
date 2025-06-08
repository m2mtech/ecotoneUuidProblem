<?php

namespace tests;

use Ecotone\Lite\EcotoneLite;
use PHPUnit\Framework\TestCase;
use App\Aggregate\Product;
use App\Command\ChangeProductCommand;
use App\Entity\Product as ProductEntity;
use App\Event\ProductChanged;
use App\Event\ProductCreated;
use Symfony\Component\Uid\Uuid;

class ProblemTest extends TestCase
{
    public function testWithEcotoneHelper(): void
    {
        $uuid = Uuid::v7();
        $product = new ProductEntity();
        $product->setProductId($uuid)->setName('test');

        $testSupport = EcotoneLite::bootstrapFlowTestingWithEventStore([Product::class]);
        $this->assertEquals([new ProductChanged($uuid, 'test')],
            $testSupport
                ->withEventsFor($uuid, Product::class, [new ProductCreated($uuid, 'initial')])
                ->sendCommand(new ChangeProductCommand($uuid, $product))
                ->getRecordedEvents()
        );
    }
}
