<?php

namespace Tests\Feature;

use App\Models\Article;
use Database\Seeders\ArticleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpFoundation\Response;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(ArticleSeeder::class);
});

it('list all articles', function () {
    $response = $this->getJson('/articles');

    $response->assertOk()
        ->assertJson(
            fn (AssertableJson $json) => $json->has('data.0.id')
           ->has('data.0.title')
           ->has('data.0.url')
           ->has('data.0.imageUrl')
           ->etc()
        );
});

it('create a new article in the database', function () {
    $response = $this->postJson('/articles', [
        'title' => "NASA's Webb Telescope Launches to See First Galaxies, Distant Worlds",
        'url' => "http://www.nasa.gov/press-release/nasas-webb-telescope-launches-to-see-first-galaxies-distant-worlds",
        'imageUrl' => 'https://www.nasa.gov/sites/default/files/thumbnails/image/webb_spacecraft_sep_12.25.png?itok=k2OSBf9T',
        'newsSite' => 'NASA',
        'summary' => 'NASA’s James Webb Space Telescope launched at 7:20 a.m. EST Saturday on an Ariane 5 rocket from Europe’s Spaceport.',
        'featured' => false,
        'launches' => [
            'id' => 'd0fa4bb2-80ea-4808-af08-7785dde53bf6',
            'provider' => 'Launch Library 2',
        ],
        'events' => [],
        'publishedAt' => '2021-12-25 13:16:00',
        'updatedAt' => '2021-12-25 15:18:25',
    ]);

    $response->assertStatus(Response::HTTP_CREATED);
});

it('get a single article from the database', function () {

    $article = Article::factory()->create();

    $response = $this->getJson("/articles/$article->id");

    $response->assertOk()
        ->assertJson(
            fn (AssertableJson $json) => $json->has('data.id')
                ->has('data.title')
                ->has('data.url')
                ->has('data.imageUrl')
                ->etc()
        );
});

it('update an article in the database', function () {

    $article = Article::factory()->create();
    $article->title = "NASA's Webb Telescope Launches to See First Galaxies, Distant Worlds and Finds New Stars";

    $response = $this->putJson("/articles/$article->id", $article->toArray());

    $response->assertStatus(Response::HTTP_OK)
        ->assertJson(
            fn (AssertableJson $json) => $json
                ->where('data.title', 'NASA\'s Webb Telescope Launches to See First Galaxies, Distant Worlds and Finds New Stars')
                ->etc()
        );
});

it('delete an article in the database', function () {

    $article = Article::factory()->create();

    $response = $this->deleteJson("/articles/$article->id");

    $response->assertOk();

    $this->assertDatabaseMissing('articles', [
        'id' => $article->id
    ]);
});
