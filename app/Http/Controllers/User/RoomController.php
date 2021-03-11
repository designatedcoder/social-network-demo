<?php

namespace App\Http\Controllers\User;

use App\Models\Room;
use Inertia\Inertia;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\NewChatMessageEvent;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Inertia::render('User/ChatRooms/Index', [
            'rooms' => Room::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Room $room) {
        $message = $room->messages()->create([
            'body' => $request->body,
            'user_id' => auth()->id()
        ]);
        broadcast(new NewChatMessageEvent($message, auth()->user()))->toOthers();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room) {
        $messages = Message::where('room_id', $room->id)
            ->with('user')
            ->oldest()
            ->get();
        return Inertia::render('User/ChatRooms/Show', [
            'room' => $room,
            'messages' => $messages,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room) {
        $room->active = $request->count;
        $room->update();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
}
