<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;

class ProductControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_show_products()
    {
        // Assuming you have some products in the database, adjust as needed
        $response = $this->get('/api/product');
        $response->assertStatus(200);
        // Add more assertions if needed
    }

    public function test_show_all_categories()
    {
        // Assuming you have some categories in the database, adjust as needed
        $response = $this->get('/api/categories');
        $response->assertStatus(200);
        // Add more assertions if needed
    }
    public function test_create_product()
    {
        // Assuming you have some categories in the database, adjust as needed
        $category = Category::factory()->create();

        Storage::fake('uploads');
        $file = UploadedFile::fake()->image('product.jpg');

        $data = [
            'name' => 'Test Product',
            'description' => 'Product description',
            'price' => 19.99,
            'image' => $file,
            'categorie' => $category->categorie_id,
        ];

        $response = $this->json('POST', '/api/product', $data);

        $response->assertStatus(200)
            ->assertJson(['name' => 'Test Product']); // Adjust based on your response structure

        // Add more assertions if needed, for example, check if the product was actually stored in the database
        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
    }
}
