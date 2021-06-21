<?php

namespace Database\Factories;

use App\Models\Price;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class PriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Price::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => $this->faker->numberBetween(25, 250),
            'book_id' => Book::pluck('id')->random()
        ];
    }
}
