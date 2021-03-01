<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user) {
        $posts = Post::where('parent_id', $user->id)
            ->orWhere('user_id', $user->id)
            ->where('parent_id', null)
            ->latest()
            ->paginate(5);
        if ($request->wantsJson()) {
            return $posts;
        }
        return Inertia::render('User/Profile/Show', [
            'profile' => $user,
            'posts' => $posts,
            'isFriendsWith' => auth()->user()->is_friends_with($user->id),
            'friendRequestSentTo' => auth()->user()->has_pending_friend_request_sent_to($user->id),
            'friendRequestRecievedFrom' => auth()->user()->has_pending_friend_request_from($user->id),
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
