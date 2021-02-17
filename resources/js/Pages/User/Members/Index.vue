<template>
    <pages-layout>
        <template #title>
            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <inertia-link :href="route('members.index')" class="capitalize underline">
                        Members
                    </inertia-link>
                </h2>
                <span class="text-gray-800 leading-tight text-lg capitalize mt-5 sm:mt-0">
                    Visit your
                    <inertia-link href="#" class="underline hover:text-green-500">friends</inertia-link>
                </span>
            </div>
        </template>

        <user-block :items="members"></user-block>
    </pages-layout>
</template>

<script>
    import PagesLayout from '@/Layouts/PagesLayout'
    import UserBlock from '@/Components/UserBlock'
    export default {
        props: ['members'],
        components: {
            PagesLayout,
            UserBlock,
        }
    }
</script>