<?php

namespace App\Http\Controllers\User;

use App\Events\FriendRequestAcceptedEvent;
use App\Events\FriendRequestReceivedEvent;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Inertia::render('User/Friends/Index', [
            'friends' => auth()->user()->friends(),
            'requests' => auth()->user()->pending_friend_requests(),
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
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user) {
        if (!$user) {
            return back()->withErrors(['message' => 'This user could not be found']);
        }
        auth()->user()->add_friend($user->id);
        event(new FriendRequestReceivedEvent($user));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
        if (!$user) {
            return back()->withErrors(['message' => 'This user could not be found']);
        }
        auth()->user()->accept_friend($user->id);
        event(new FriendRequestAcceptedEvent($user));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        if (!$user) {
            return back()->withErrors(['message' => 'This user could not be found']);
        }
        auth()->user()->delete_friend($user->id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function deny(User $user) {
        if (!$user) {
            return back()->withErrors(['message' => 'This user could not be found']);
        }
        auth()->user()->deny_friend($user->id);
        return back();
    }
}
