<?php

namespace Tests\Feature\Adm;

use App\Models\Category;
use App\Models\Condominia;
use App\Models\Product;
use App\Models\ProductBarcodes;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_index_count_products()
    {
        $role = Role::factory()->create(['name' => 'master']);
        // created basic
        $user = User::factory()->create();
        $cond = Condominia::factory()->create();
        //products
        $cate = Category::factory()->create();
        $prodC = $cate->products()->create([
            'name' => fake()->name(),
            'user_id' => $user->id,
            'value' => random_int(1,100),
            'type' => 'Pilsen'
        ]);
        $barcP = ProductBarcodes::factory(2)->create();

        // $prod = Product::factory()->create();
        // $barc = ProductBarcodes::factory()->create();
        // $count =
        // dd($barcP);
        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertSee('products');
    }
}
