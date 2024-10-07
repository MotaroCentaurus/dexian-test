<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\ProductType;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductModelTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testProductBelongsToProductType()
    {
        $productType = ProductType::factory()->create();
        $product = Product::factory()->create(['product_type_id' => $productType->product_type_id]);

        $this->assertInstanceOf(ProductType::class, $product->productType);
    }

    public function testProductCanBeCreated()
    {
        $product = Product::factory()->create();
        $foundProduct = Product::find($product->product_id);

        $this->assertNotNull($product);
        $this->assertNotNull($foundProduct);
        $this->assertEquals($product->product_id, $foundProduct->product_id);
    }

    public function testProductCanBeUpdated()
    {
        $product = Product::factory()->create();

        $product->update(['product_name' => 'Updated Product']);

        $foundProduct = Product::find($product->product_id);

        $this->assertEquals($foundProduct->product_name, 'Updated Product');
    }

    public function testProductCanBeRead()
    {
        $product = Product::factory()->create();

        $foundProduct = Product::find($product->product_id);

        $this->assertEquals($product->product_name, $foundProduct->product_name);
    }

    public function testProductCanBeDeleted()
    {
        $product = Product::factory()->create();

        $product->delete();

        $foundProduct = Product::find($product->product_id);

        $this->assertEmpty($foundProduct);
    }
}
