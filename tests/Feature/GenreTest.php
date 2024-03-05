<?php

namespace Tests\Feature;

use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenreTest extends TestCase
{
    use RefreshDatabase; // This trait resets the database after each test

    /**
     * Test genre creation.
     *
     * @return void
     */
    public function testGenreCreation()
    {
        // Create the genres
        Genre::create(['name' => 'Action']);
        Genre::create(['name' => 'Adventure']);

        // Check if the genres exist in the database
        $this->assertDatabaseHas('genres', ['name' => 'Action']);
        $this->assertDatabaseHas('genres', ['name' => 'Adventure']);
    }
}
