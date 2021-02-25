<template>
    <div class="flex flex-col">
        <h3 class="font-semibold text-lg text-gray-800 leading-tight mt-5">Suggestions:</h3>
        <div class="flex mb-5 pb-5">
            <div v-for="user in suggestions" :key="user.id" class="w-1/5">
                <inertia-link :href="route('profiles.show', user.username)" class="sm:w-1/2">
                    <div class="flex flex-col items-center px-2 py-3 border-l border-gray-400 mt-5 hover:bg-gray-200">
                        <img class="h-8 w-8 rounded-full object-cover " :src="user.profile_photo_url" :alt="user.username" :title="user.username" />
                    </div>
                </inertia-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['suggestions']
    }
</script>
