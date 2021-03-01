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
        <infinite-scroll @loadMore="loadMoreMembers">
            <user-block :items="allMembers.data"></user-block>
        </infinite-scroll>
    </pages-layout>
</template>

<script>
    import InfiniteScroll from '@/Components/InfiniteScroll'
    import PagesLayout from '@/Layouts/PagesLayout'
    import UserBlock from '@/Components/UserBlock'
    export default {
        props: ['members'],
        components: {
            InfiniteScroll,
            PagesLayout,
            UserBlock,
        },
        data() {
            return {
                allMembers: this.members
            }
        },
        methods: {
            loadMoreMembers() {
                if (!this.allMembers.next_page_url) {
                    return
                }
                return axios.get(this.allMembers.next_page_url)
                    .then(resp => {
                        this.allMembers = {
                            ...resp.data,
                            data: [
                                ...this.allMembers.data, ...resp.data.data
                            ]
                        }
                    })
            }
        },
    }
</script>
