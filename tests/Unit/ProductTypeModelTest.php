<?php

namespace Tests\Unit;

use App\Models\ProductType;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductTypeModelTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testProductTypeCanBeCreated()
    {
        $productType = ProductType::factory()->create();
        $foundProductType = ProductType::find($productType->product_type_id);

        $this->assertNotNull($productType);
        $this->assertNotNull($foundProductType);
        $this->assertEquals($productType->product_type_id, $foundProductType->product_type_id);
    }

    public function testProductTypeCanBeUpdated()
    {
        $productType = ProductType::factory()->create();

        $productType->update(['product_type' => 'Updated Type']);

        $foundProductType = ProductType::find($productType->product_type_id);

        $this->assertEquals($foundProductType->product_type, 'Updated Type');
    }

    public function testProductTypeCanBeRead()
    {
        $productType = ProductType::factory()->create();

        $foundProductType = ProductType::find($productType->product_type_id);

        $this->assertEquals($productType->product_type, $foundProductType->product_type);
    }

    public function testProductTypeCanBeDeleted()
    {
        $productType = ProductType::factory()->create();

        $productType->delete();

        $foundProductType = ProductType::find($productType->product_type_id);

        $this->assertEmpty($foundProductType);
    }
}
