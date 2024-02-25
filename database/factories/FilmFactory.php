<?php

namespace Database\Factories;

use App\Models\Film;
use App\Models\Actor;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'overview' => fake()->paragraph(),
        ];
    }

        /**
     * Indicate that the film should be created with genres and actors.
     *
     * @return $this
     */
    public function withGenresAndActors()
    {
        return $this->afterCreating(function (Film $film) {
            $genres = Genre::all()->random(3); 
            $actors = Actor::all()->random(6);

            $film->genres()->attach($genres);
            $film->actors()->attach($actors);
        });
    }
}
