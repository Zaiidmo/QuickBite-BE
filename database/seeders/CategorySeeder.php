<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Pizza', 'description' => 'Delicious Italian pizza with various toppings.'],
            ['name' => 'Tacos', 'description' => 'Authentic Mexican tacos filled with savory ingredients.'],
            ['name' => 'BBQ', 'description' => 'Succulent barbecued meats and grilled vegetables.'],
            ['name' => 'Burgers', 'description' => 'Juicy beef patties served on toasted buns with all the fixings.'],
            ['name' => 'Sushi', 'description' => 'Freshly prepared sushi rolls with rice, fish, and vegetables.'],
            ['name' => 'Pasta', 'description' => 'Classic Italian pasta dishes made with al dente noodles and rich sauces.'],
            ['name' => 'Salads', 'description' => 'Healthy and refreshing salads with a variety of greens and toppings.'],
            ['name' => 'Sandwiches', 'description' => 'Gourmet sandwiches served on artisan bread with premium ingredients.'],
            ['name' => 'Seafood', 'description' => 'Fresh seafood dishes including fish, shrimp, and crab.'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'description' => $category['description'],
            ]);
        }
    }
}
