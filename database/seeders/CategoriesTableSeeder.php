<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $major_category = [
            'Beverages',
            'Appetizers',
            'Main Course',
            'Desserts',
            'Others'
        ];

        $beverage_categories = [
            'Coffee',
            'Tea',
            'Juice',
            'Soda',
            'Water'
        ];

        $appetizer_categories = [
            'Salad',
            'Soup',
            'Fries',
            'Cheese Sticks',
            'Onion Rings'
        ];

        $main_course_categories = [
            'Beef',
            'Chicken',
            'Pork',
            'Fish',
            'Vegetables'
        ];

        $dessert_categories = [
            'Cake',
            'Ice Cream',
            'Pudding'
        ];

        $other_categories = [
            'Pizza',
            'Pasta',
            'Sandwich',
            'Burger',
            'Hotdog'
        ];

        foreach($major_category as $majorCategory){
            if($majorCategory == 'Beverages'){
                foreach($beverage_categories as $beverage_category){
                    $category = Category::create([
                        'name' => $beverage_category,
                        // 'parent_id' => $category->id,
                        'status' => 'active',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            if($majorCategory == 'Appetizers'){
                foreach($appetizer_categories as $appetizer_category){
                    $category = Category::create([
                        'name' => $appetizer_category,
                        // 'parent_id' => $category->id,
                        'status' => 'active',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            if($majorCategory == 'Main Course'){
                foreach($main_course_categories as $main_course_category){
                    $category = Category::create([
                        'name' => $main_course_category,
                        // 'parent_id' => $category->id,
                        'status' => 'active',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            if($majorCategory == 'Desserts'){
                foreach($dessert_categories as $dessert_category){
                    $category = Category::create([
                        'name' => $dessert_category,
                        // 'parent_id' => $category->id,
                        'status' => 'active',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            if($majorCategory == 'Others'){
                foreach($other_categories as $other_category){
                    $category = Category::create([
                        'name' => $other_category,
                        // 'parent_id' => $category->id,
                        'status' => 'active',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

    }
}
