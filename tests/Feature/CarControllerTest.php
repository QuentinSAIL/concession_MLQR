<?php

namespace Tests\Feature;

use App\Models\Car;
use Tests\TestCase;
use App\Models\User;
use App\Models\Brand;
use App\Models\Carmodel;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    public $carmodel;
    public $user;
    public $brand;

    public function setUp(): void
    {
        parent::setUp();

        // Create a car model in the database for foreign key references.
        $this->brand = Brand::factory()->count(3)->create();

        $this->carmodel = Carmodel::factory()->count(3)->create();

    }

    public function test_index()
    {
        $car = Car::factory()->create();
        $response = $this->get('/api/cars');
        $response = $this->get('/api/cars');
        $response->assertStatus(200)
                 ->assertJson([$car->toArray()]);
    }

    public function test_store()
    {
        $response = $this->post('/api/cars/store', [
            'carmodel_id' => Carmodel::factory()->create()->id,
        ]);
        $response->assertStatus(201);
    }

    public function test_update()
    {
        $car = Car::factory()->create(['carmodel_id' => Carmodel::factory()->create()->id]);
        $response = $this->put("/api/cars/{$car->id}", [
            'carmodel_id' => Carmodel::factory()->create()->id,
        ]);
        $response->assertStatus(200);
    }

    public function test_destroy()
    {
        $car = Car::factory()->create();
        $response = $this->delete("/api/cars/{$car->id}");
        $response->assertStatus(200);    }
}
