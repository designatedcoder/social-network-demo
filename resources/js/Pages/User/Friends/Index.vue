<template>
    <pages-layout>
        <template #title>
            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <span class="underline">
                        {{ `${$page.props.user.username}'s Friends` }}
                    </span>
                </h2>

                <span class="text-gray-800 leading-tight text-lg capitalize mt-5 sm:mt-0">
                    Browse
                    <inertia-link :href="route('members.index')" class="underline hover:text-green-500">
                        members
                    </inertia-link>
                </span>
            </div>
        </template>
        <div>
            <h3 class="font-semibold text-lg text-gray-800 leading-tight mt-5">
                Friend Requests:
            </h3>
            <div v-if="requests.length <= 0">
                <h3>You have no friend requests.</h3>
            </div>
            <user-block :items="requests"></user-block>
        </div>
        <div>
            <h3 class="font-semibold text-lg text-gray-800 leading-tight mt-5">
                Friends:
            </h3>
            <div v-if="friends.length <= 0">
                <h3>You have no friends yet.</h3>
            </div>
            <user-block :items="friends"></user-block>
        </div>
    </pages-layout>
</template>

<script>
    import PagesLayout from '@/Layouts/PagesLayout'
    import UserBlock from '@/Components/UserBlock'
    export default {
        props: ['friends', 'requests'],
        components: {
            PagesLayout,
            UserBlock
        }
    }
</script>
