<template>
    <div>
        <template v-if="unread">
            <inertia-link :href="unread.data.info.link" class="flex leading-5" @click="markOneAsRead(unread.id)">
                <img :src="unread.data.info.avatar" class="h-8 w-8 rounded-full object-cover">
                <div class="flex flex-col items-start text-left">
                    <span class="text-sm mx-2">{{ unread.data.info.message }}</span>
                    <span class="text-xs mx-2">{{ unreadTimeAgo }}</span>
                    <!-- <span class="text-xs mx-2">{{ unread.data.info.sent | timeAgo }}</span> -->
                </div>
            </inertia-link>
            <inertia-link href="#" class="p-2 rounded-md text-gray-500 hover:bg-gray-500 hover:text-gray-300" @click="markForDelete(unread.id)">
                <icon name="trash" class="w-4 h-4 fill-current"></icon>
            </inertia-link>
        </template>

        <template v-if="read">
            <inertia-link :href="read.data.info.link" class="flex leading-5" @click="markOneAsRead(read.id)">
                <img :src="read.data.info.avatar" class="h-8 w-8 rounded-full object-cover">
                <div class="flex flex-col items-start text-left">
                    <span class="text-sm mx-2">{{ read.data.info.message }}</span>
                    <span class="text-xs mx-2">{{ readTimeAgo }}</span>
                    <!-- <span class="text-xs mx-2">{{ read.data.info.sent | timeAgo }}</span> -->
                </div>
            </inertia-link>
            <inertia-link href="#" class="p-2 rounded-md text-gray-500 hover:bg-gray-500 hover:text-gray-300" @click="markForDelete(read.id)">
                <icon name="trash" class="w-4 h-4 fill-current"></icon>
            </inertia-link>
        </template>
    </div>
</template>
<script>
    export default {
        props: ['unread', 'read'],
        computed: {
            unreadTimeAgo() {
                let dateString = this.unread.data.info.sent
                let options = {year: "numeric", month: "long", day: "numeric"}
                return new Date(dateString).toLocaleDateString(undefined, options)
            },
            readTimeAgo() {
                let dateString = this.read.data.info.sent
                let options = {year: "numeric", month: "long", day: "numeric"}
                return new Date(dateString).toLocaleDateString(undefined, options)
            },
        },
        methods: {
            markOneAsRead(id) {
                axios.post(this.route('notifications.store', id))
            },
            markForDelete(id) {
                axios.get(this.route('notifications.destroy', id))
                    .then(() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Your notification has successfully been deleted!'
                        })
                    })
            }
        }
    }
</script>
