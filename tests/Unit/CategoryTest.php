<?php

namespace Tests\Unit;

use App\Models\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function test_category_getters_and_setters(): void
    {
        $category = new Category;

        $category->setId(1);
        $category->setName('Action');
        $category->setDescription('Games focused on combat and challenges.');

        $this->assertEquals(1, $category->getId());
        $this->assertEquals('Action', $category->getName());
        $this->assertEquals(
            'Games focused on combat and challenges.',
            $category->getDescription()
        );
    }
}
