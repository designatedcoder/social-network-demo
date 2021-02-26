<?php

namespace App\Traits;

trait Likeable {

    public function hasLiked($query) {
        return (bool) $query->likes
            ->where('like', 1)
            ->where('likeable_id', $query->id)
            ->where('likeable_type', get_class($query))
            ->where('user_id', $this->id)
            ->count();
    }

    public function hasDisliked($query) {
        return (bool) $query->likes
            ->where('dislike', 1)
            ->where('likeable_id', $query->id)
            ->where('likeable_type', get_class($query))
            ->where('user_id', $this->id)
            ->count();
    }

    public function changeToDislike($query) {
        $likes = $query->likes()->where('like', 1)->where('dislike', 0)->where('user_id', $this->id)->first();
        $likes->like -=1;
        $likes->dislike +=1;
        $likes->update();
    }

    public function changeToLike($query) {
        $likes = $query->likes()->where('dislike', 1)->where('like', 0)->where('user_id', $this->id)->first();
        $likes->like +=1;
        $likes->dislike -=1;
        $likes->update();
    }

    public function like($query) {
        if($this->id != $query->user_id && !$this->is_friends_with($query->user_id)) {
            return back();
        } else {
            if($this->hasLiked($query)) {
                return back();
            }
            if($this->hasdisliked($query)) {
                $this->changeToLike($query);
                return back();
            }
            else {
                $query->likes()->create([
                    'user_id' => $this->id,
                    'like' => 1,
                ]);
                return back();
            }
        }
    }

    public function dislike($query) {
        if($this->id != $query->user_id && !$this->is_friends_with($query->user_id)) {
            return back();
        } else {
            if($this->hasDisliked($query)) {
                return back();
            }
            if($this->hasLiked($query)) {
                $this->changeToDislike($query);
                return back();
            }
            else {
                $query->likes()->create([
                    'user_id' => $this->id,
                    'dislike' => 1,
                ]);
                return back();
            }
        }
    }
}
