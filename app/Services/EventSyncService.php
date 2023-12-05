<?php

namespace App\Services;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class EventSyncService
{
    public function handle(array $events, User $user): Collection
    {
        foreach ($events as $eventData) {
            $this->sync($eventData, $user);
        }

        return Event::ownedBy($user->id)->get();
    }

    public function sync(array $data, User $user): Event
    {
        $event = new Event();
        $event->name = $data['name'];
        $event->user()->associate($user);
        $event->save();

        if (array_key_exists('bills', $data)) {
            $event->bills()->sync($data['bills']);
        }
        if (array_key_exists('people', $data)) {
            $event->people()->sync($data['people']);
        }
        $event->refresh();
        return $event;
    }
}