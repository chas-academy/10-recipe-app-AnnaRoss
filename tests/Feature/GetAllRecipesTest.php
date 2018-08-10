<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetAllRecipesTest extends TestCase
{
    public function testGetAllRecipes()
    {
        $recipe = factory(\App\Recipe::class)->create();

        $this->get('api/recipes')
        ->assertJsonFragment([
            'id' => $recipe->id,
            'title' => $recipe->title,
        ]);
    }
}
