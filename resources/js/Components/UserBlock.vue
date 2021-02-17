<template>
    <div class="sm:flex sm:flex-wrap">
        <inertia-link :href="route('profiles.show', item.username)" class="sm:w-1/2" v-for="(item, index) in items" :key="index">
            <div class="flex items-center bg-gray-50 px-2 py-3 border-l border-gray-500 mt-5 hover:bg-gray-400 hover:text-blue-800">
                <div class="flex flex-shrink-0">
                    <img :src="item.profile_photo_url" :alt="item.username" class="h-8 w-8 rounded-full object-cover">
                </div>
                <div class="flex flex-grow overflow-hidden">
                    <span class="text-lg ml-3">
                        {{ item.username }}
                    </span>
                </div>
            </div>
        </inertia-link>
    </div>
</template>

<script>
    export default {
        props: ['items']
    }
</script>