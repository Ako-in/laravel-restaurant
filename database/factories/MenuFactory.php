<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word, // 必須フィールドの設定
            'price' => $this->faker->numberBetween(500, 5000), // 価格設定
            'stock' => $this->faker->numberBetween(1, 50), // 在庫数
            'description' => $this->faker->sentence, // 説明文
            'image' => null, // 必要であれば画像のパス
            'category_id' => $this->faker->numberBetween(1, 5), // カテゴリーID
            'status' => $this->faker->randomElement(['active', 'nonactive']), // ステータス
        ];
    }
}
