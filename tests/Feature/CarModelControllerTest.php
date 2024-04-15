<?php

namespace Tests\Feature;

use App\Models\Carmodel;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarmodelControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_retrieve_all_car_models()
    {
        Brand::factory()->create();
        // Arrange
        Carmodel::factory()->count(3)->create();

        // Act
        $response = $this->get('/api/carmodels');

        // Assert
        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /** @test */
    public function can_create_car_model_with_valid_data()
    {
        // Arrange
        $brand = Brand::factory()->create();
        $data = ['name' => 'Model X', 'brand_id' => $brand->id];

        // Act
        $response = $this->post('/api/carmodels/store', $data);

        // Assert
        $response->assertStatus(201);
        $response->assertJson($data);
        $this->assertDatabaseHas('carmodels', $data);
    }

    /** @test */
    public function cannot_create_car_model_without_name()
    {
        // Arrange
        $brand = Brand::factory()->create();
        $data = ['brand_id' => $brand->id];

        // Act
        $response = $this->post('/api/carmodels/store', $data);

        // Assert
        $response->assertStatus(302);
    }

    /** @test */
    public function cannot_create_car_model_with_non_existing_brand()
    {
        // Arrange
        $data = ['name' => 'Model Y', 'brand_id' => 999]; // Assuming 999 does not exist

        // Act
        $response = $this->post('/api/carmodels/store', $data);

        // Assert
        $response->assertStatus(302);
    }



    /** @test */
    public function can_update_car_model_with_valid_data()
    {
        $brand = Brand::factory()->create();
        // Arrange
        $carmodel = Carmodel::factory()->create();
        $data = ['name' => 'Model Z', 'brand_id' => $carmodel->brand_id];

        // Act
        $response = $this->put("/api/carmodels/{$carmodel->id}", $data);

        // Assert
        $response->assertStatus(200);
    }

    /** @test */
    public function cannot_update_car_model_without_name()
    {
        $brand = Brand::factory()->create();
        // Arrange
        $carmodel = Carmodel::factory()->create();
        $data = ['name' => '', 'brand_id' => $carmodel->brand_id];

        // Act
        $response = $this->put("/api/carmodels/{$carmodel->id}", $data);

        // Assert
        $response->assertStatus(302);
    }

    /** @test */
    public function can_delete_car_model()
    {
        $brand = Brand::factory()->create();
        // Arrange
        $carmodel = Carmodel::factory()->create();

        // Act
        $response = $this->delete("/api/carmodels/{$carmodel->id}");

        // Assert
        $response->assertStatus(200);
    }
}
