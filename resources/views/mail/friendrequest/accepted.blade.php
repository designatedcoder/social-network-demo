@component('mail::message')
# Friend Request Accepted

**You're friend request has been accepted by:**

**Name:** {{ $user->name }}

**Username:** {{ $user->username }}

@component('mail::button', ['url' => route('profiles.show', $user->username)])
Visit their profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
