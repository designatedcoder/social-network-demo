<template>
    <pages-layout>
        <template #title>
            <div class="flex justify-between items-center w-full">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <img :src="profile.profile_photo_url" :alt="profile.username" class="h-8 w-8 rounded-full object-cover">
                    <span class="capitalize ml-3">{{ `${profile.username}'s Profile` }}</span>
                </h2>

                <status :profile="profile" :isFriendsWith="isFriendsWith" :friendRequestSentTo="friendRequestSentTo" :friendRequestRecievedFrom="friendRequestRecievedFrom"></status>
            </div>
        </template>

    </pages-layout>
</template>

<script>
    import PagesLayout from '@/Layouts/PagesLayout'
    import Status from '@/Components/FriendStatus/Status'
    export default {
        props: ['profile', 'isFriendsWith', 'friendRequestSentTo', 'friendRequestRecievedFrom'],
        components: {
            PagesLayout,
            Status
        }
    }
</script>
