<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
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
        ];
    }
}
