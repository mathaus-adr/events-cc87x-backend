<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonEvent>
 */
class PersonEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'person_id' => Person::factory()->create()->id,
            'event_id' => Event::factory()->create()->id,
        ];
    }
}
