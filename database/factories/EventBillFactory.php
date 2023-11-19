<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventBill>
 */
class EventBillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => Event::factory()->create()->id,
            'bill_id' => Bill::factory()->create()->id
        ];
    }
}
