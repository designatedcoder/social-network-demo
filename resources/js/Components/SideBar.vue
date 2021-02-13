<template>
    <aside class="flex flex-col bg-white shadow py-6 w-full sm:w-1/3 lg:w-1/4">
        <inertia-link href="#" class="flex items-end pl-6 py-2 text-gray-800 hover:bg-gray-500 hover:text-white">
            <img :src="$page.props.user.profile_photo_url" :alt="$page.props.user.username" class="h-8 w-8 rounded-full object-cover">
            <span class="ml-2">{{ $page.props.user.username }}</span>
        </inertia-link>
    </aside>
</template>

<script>
    export default {

    }
</script>
