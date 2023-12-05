<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Services\EventSyncService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Event::with(['bills', 'people'])->where('user_id', auth()->user()->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|required',
            'people' => 'array|nullable',
            'people.*' => 'integer',
            'bills' => 'array|nullable',
            'bills.*' => 'integer'
        ]);
        /** @var EventSyncService $service * */
        $service = app(EventSyncService::class);
        /** @var User $user * */
        $user = auth()?->user();
        $event = $service->sync($validated, $user);

        $event->load('bills');
        $event->load('people');

        return $event;
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load('bills');
        $event->load('people');
        return $event;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'people' => 'array|nullable',
            'people.*' => 'integer',
            'bills' => 'array|nullable',
            'bills.*' => 'integer'
        ]);
        $event->bills()->sync($validated['bills']);
        $event->people()->sync($validated['people']);
        $event->update();
        $event->load('bills');
        $event->load('people');
        $event->refresh();
        return response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
