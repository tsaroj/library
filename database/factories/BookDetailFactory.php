<?php

namespace Database\Factories;

use App\Models\BookDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'book_id' => \App\Models\Book::pluck('id')->random(),
            'book_code' => $this->faker->unique()->numberBetween($min = 100000, $max = 999999),
            'edition' => $this->faker->numberBetween($min = 1, $max = 5),
            'price' => $this->faker->numberBetween($min = 1000, $max = 9999),
        ];
    }
}
