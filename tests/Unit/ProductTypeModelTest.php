<?php

namespace Tests\Unit;

use App\Models\ProductType;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductTypeModelTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function test_product_type_can_be_created()
    {
        $productType = ProductType::factory()->create();
        $foundProductType = ProductType::find($productType->product_type_id);

        $this->assertNotNull($productType);
        $this->assertNotNull($foundProductType);
        $this->assertEquals($productType->product_type_id, $foundProductType->product_type_id);
    }

    public function test_product_type_can_be_updated()
    {
        $productType = ProductType::factory()->create();

        $productType->update(['product_type' => 'Updated Type']);

        $foundProductType = ProductType::find($productType->product_type_id);

        $this->assertEquals($foundProductType->product_type, 'Updated Type');
    }

    public function test_product_type_can_be_read()
    {
        $productType = ProductType::factory()->create();

        $foundProductType = ProductType::find($productType->product_type_id);

        $this->assertEquals($productType->product_type, $foundProductType->product_type);
    }

    public function test_product_type_can_be_deleted()
    {
        $productType = ProductType::factory()->create();

        $productType->delete();

        $foundProductType = ProductType::find($productType->product_type_id);

        $this->assertEmpty($foundProductType);
    }
}
