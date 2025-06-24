<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class reviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'book_id' => Book::factory(),
            'content' => $this->faker->paragraph,
            'rating'=> $this->faker->numberBetween(1,5),
        ];
    }
}
