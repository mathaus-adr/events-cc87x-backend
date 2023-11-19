<?php

namespace Tests\Feature;

use App\Models\Bill;
use App\Models\Event;
use App\Models\EventBill;
use App\Models\Person;
use App\Models\PersonEvent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     * @test
     */
    public function can_create_a_event_test(): void
    {
        $user = User::factory()->create();
        $persons = Person::factory(5)->create();
        $bills = Bill::factory(10)->create();
        $this->actingAs($user);
        $peopleArray = $persons->pluck('id')->toArray();
        $billsArray = $bills->pluck('id')->toArray();
        $response = $this->post(
            '/api/events',
            ['name' => 'test', 'people' => $peopleArray, 'bills' => $billsArray]
        );
        $response->assertStatus(201);
        $returnedData = $response->json();
        $this->assertDatabaseHas(Event::class, ['id' => $returnedData['id'], 'user_id' => $user->id]);
        $this->assertDatabaseHas(PersonEvent::class, ['event_id' => $returnedData['id']]);
        $this->assertDatabaseHas(EventBill::class, ['event_id' => $returnedData['id']]);
    }

    /**
     * a new test
     * @test
     */
    public function can_return_events_test(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $events = Event::factory(10)->create(['user_id' => $user->id]);
        foreach ($events as $event) {
            PersonEvent::factory(2)->create(['event_id' => $event->id]);
            EventBill::factory(2)->create(['event_id' => $event->id]);
        }
        $response = $this->get(
            '/api/events'
        );
        $response->assertStatus(200);
    }
}
