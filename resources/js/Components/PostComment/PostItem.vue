<template>
    <div class="flex border-t border-gray-400 mt-5 py-5 space-x-5">
        <div class="flex-shrink-0">
            <inertia-link :href="route('profiles.show', post.user.username)">
                <img class="h-8 w-8 rounded-full object-cover" :src="post.user.profile_photo_url" :alt="post.user.username">
            </inertia-link>
        </div>

        <div class="flex-1">
            <div>
                <div class="flex justify-between">
                    <h2 class="text-lg font-semibold underline">
                        <inertia-link :href="route('profiles.show', post.user.username)">{{ post.user.username }}</inertia-link>
                    </h2>
                </div>
                <p class="bg-gray-100 rounded mt-3 px-3 py-2">
                    {{ post.body }}
                </p>
            </div>

            <div class="flex items-end my-3">
                <div>
                    <span class="text-sm italic">3 days ago</span>
                </div>

                <div class="flex ml-3">
                    <span>Like</span>
                    <span class="ml-2">Dislike</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['post']
    }
</script>
