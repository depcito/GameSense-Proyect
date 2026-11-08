<?php

namespace Tests\Unit;

use App\Models\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function test_product_getters_and_setters(): void
    {
        $product = new Product;

        $product->setId(1);
        $product->setTitle('FIFA 25');
        $product->setDescription('Football simulation game');
        $product->setPrice(150000.0);
        $product->setStock(10);
        $product->setFormat('Physical');
        $product->setType('Video Game');
        $product->setPlatform('PlayStation 5');

        $this->assertEquals(1, $product->getId());
        $this->assertEquals('FIFA 25', $product->getTitle());
        $this->assertEquals('Football simulation game', $product->getDescription());
        $this->assertEquals(150000.0, $product->getPrice());
        $this->assertEquals(10, $product->getStock());
        $this->assertEquals('Physical', $product->getFormat());
        $this->assertEquals('Video Game', $product->getType());
        $this->assertEquals('PlayStation 5', $product->getPlatform());
    }
}
