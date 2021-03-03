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

        <post-form :method="submit" :form="form" :text="'Post'"></post-form>

        <infinite-scroll @loadMore="loadMorePosts">
            <combined-posts :posts="allPosts.data" :pagination="pagination"></combined-posts>
        </infinite-scroll>

    </pages-layout>
</template>

<script>
    import CombinedPosts from '@/Components/PostComment/CombinedPosts'
    import InfiniteScroll from '@/Components/InfiniteScroll'
    import PagesLayout from '@/Layouts/PagesLayout'
    import PostForm from '@/Components/PostComment/PostForm'
    import Status from '@/Components/FriendStatus/Status'
    export default {
        props: ['profile', 'posts', 'isFriendsWith', 'friendRequestSentTo', 'friendRequestRecievedFrom'],
        components: {
            CombinedPosts,
            InfiniteScroll,
            PagesLayout,
            PostForm,
            Status
        },
        data() {
            return {
                form: this.$inertia.form({
                    body: this.body,
                    user_id: this.profile.id
                }),
                allPosts: this.posts
            }
        },
        computed: {
            pagination() {
                return this.allPosts = this.posts
            }
        },
        methods: {
            submit() {
                this.form.post(this.route('posts.store'), {
                    preserveScroll: true,
                    onSuccess:()=>{
                        Toast.fire({
                            icon: 'success',
                            title: 'Your post has successfully been published!'
                        })
                        this.form.body = null
                    }
                })
            },
            loadMorePosts() {
                if (!this.allPosts.next_page_url) {
                    return
                }
                return axios.get(this.allPosts.next_page_url)
                    .then(resp => {
                        this.allPosts = {
                            ...resp.data,
                            data: [
                                ...this.allPosts.data, ...resp.data.data
                            ]
                        }
                    })
            }
        }
    }
</script>
