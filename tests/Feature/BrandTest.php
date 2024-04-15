<?php

namespace Tests\Feature;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_brands(): void
    {
        $brands = Brand::factory()->count(3)->create();

        $response = $this->get(route('brand.index'));

        $response->assertStatus(200)
            ->assertJson($brands->toArray());
    }

    public function test_can_create_brand(): void
    {
        $data = ['name' => 'Test Brand'];

        $response = $this->postJson(route('brand.store'), $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('brands', $data);
    }

    public function test_can_show_brand(): void
    {
        $brand = Brand::factory()->create();

        $response = $this->get(route('brand.show', $brand->id));

        $response->assertStatus(200);
    }

    public function test_can_update_brand(): void
    {
        $brand = Brand::factory()->create();
        $data = ['name' => 'Updated Brand'];

        $response = $this->putJson(route('brand.update', $brand->id), $data);

        $response->assertStatus(200);

    }

    public function test_can_delete_brand(): void
    {
        $brand = Brand::factory()->create();

        $response = $this->delete(route('brand.destroy', $brand->id));

        $response->assertStatus(200);
    }
}
