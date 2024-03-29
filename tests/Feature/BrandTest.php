<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrandTest extends TestCase
{
    /**
     * Test the BrandController@index
     */
    public function testBrandIndex()
    {
        $response = $this->getJson('/api/brands');
        $response->assertStatus(200);

        $brands = collect($response->json()['data'])->pluck('name')->toArray();
        $uniqueBrands = array_unique($brands);

        $this->assertEquals(count($brands), count($uniqueBrands), 'Duplicate brand names found.');
    }
}
