<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Electronic devices and gadgets',
            ],
            [
                'name' => 'Clothing',
                'description' => 'Apparel and fashion items',
            ],
            [
                'name' => 'Home & Kitchen',
                'description' => 'Items for home and kitchen use',
            ],
            [
                'name' => 'Books',
                'description' => 'Books and publications',
            ],
            [
                'name' => 'Sports & Outdoors',
                'description' => 'Sports equipment and outdoor gear',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
