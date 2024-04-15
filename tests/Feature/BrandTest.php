<?php

namespace Tests\Feature;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_brands()
    {
        $brands = Brand::factory()->count(3)->create();

        $response = $this->get('/api/brands');

        $response->assertStatus(200)
            ->assertJson($brands->toArray());
    }

    public function test_can_create_brand()
    {
        $data = ['title' => 'Test Brand'];

        $response = $this->postJson('/api/brands/store', $data);

        $response->assertStatus(201)
            ->assertJson($data);

        $this->assertDatabaseHas('brands', $data);
    }

    public function test_can_show_brand()
    {
        $brand = Brand::factory()->create();

        $response = $this->get("/api/brands/{$brand->id}");

        $response->assertStatus(200)
            ->assertJson($brand->toArray());
    }

    public function test_can_update_brand()
    {
        $brand = Brand::factory()->create();
        $data = ['title' => 'Updated Brand'];

        $response = $this->putJson("/api/brands/{$brand->id}", $data);

        $response->assertStatus(200)
            ->assertJson($data);

        $this->assertDatabaseHas('brands', $data);
    }

    public function test_can_delete_brand()
    {
        $brand = Brand::factory()->create();

        $response = $this->delete("/api/brands/{$brand->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('brands', ['id' => $brand->id]);
    }
}
