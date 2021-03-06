@component('mail::message')
# Friend Request Received

**You have received a new friend request from:**

**Name:** {{ $user->name }}

**Username:** {{ $user->username }}

@component('mail::button', ['url' => route('profiles.show', $user->username)])
Visit their profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
