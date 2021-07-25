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
                    <div class="relative">
                        <button type="button" class="focus:outline-none" @click="openMenu = !openMenu">
                            <icon name="ellipsis-h" class="w-8 h-8 fill-current"></icon>
                        </button>
                        <div v-if="openMenu" class="bg-gray-300 text-sm absolute w-48 right-0 text-gray-700 shadow-lg rounded-md px-4 py-2 hover:bg-gray-700 hover:text-gray-300 transition duration-150 ease-in-out">
                            <form @submit.prevent="deletePost">
                                <button type="submit" class="flex justify-between items-center w-full focus:outline-none">
                                    Delete Post
                                    <icon name="trash" class="w-3 h-3 fill-current"></icon>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <p class="bg-gray-100 rounded mt-3 px-3 py-2">{{ post.body }}</p>
            </div>

            <div class="flex items-end my-3">
                <div>
                    <span class="text-sm italic">{{ post.timeAgo }}</span>
                </div>

                <div class="flex ml-3">
                    <like :item="post" :method="submitLike"></like>
                    <dislike :item="post" :method="submitDislike" class="ml-2"></dislike>
                </div>
            </div>

            <post-form :method="submit" :form="form" :text="'Comment'"></post-form>
            
            <combined-comments :comments="post.comments"></combined-comments>
        </div>
    </div>
</template>

<script>
    import CombinedComments from '@/Components/PostComment/CombinedComments'
    import Dislike from '@/Components/PostComment/Likes/Dislike'
    import Like from '@/Components/PostComment/Likes/Like'
    import PostForm from '@/Components/PostComment/PostForm'
    export default {
        props: ['post'],
        components: {
            CombinedComments,
            Dislike,
            Like,
            PostForm,
        },
        data() {
            return {
                openMenu: false,
                form: this.$inertia.form({
                    body: this.body,
                    user_id: this.post.user_id,
                }),
                deleteForm: this.$inertia.form({
                    userPost: this.post
                }),
                likeForm: this.$inertia.form({
                    userPost: this.post
                }),
                dislikeForm: this.$inertia.form({
                    userPost: this.post
                })
            }
        },
        methods: {
            submit() {
                this.form.post(this.route('comments.store', this.post), {
                    preserveScroll: true,
                    onSuccess:()=>{
                        Toast.fire({
                            icon: 'success',
                            title: 'Your comment has successfully been published!'
                        })
                        this.form.body = null
                    }
                })
            },
            deletePost() {
                this.openMenu = false
                this.deleteForm.delete(this.route('posts.destroy', this.post), {
                    preserveScroll: true,
                    onError: () => {
                        Toast.fire({
                            icon: 'error',
                            title: 'You do not have permission to delete this post!',
                        })
                    },
                    onSuccess:()=>{
                        Toast.fire({
                            icon: 'success',
                            title: 'Post has successfully been deleted!'
                        })
                    }
                })
            },
            submitLike() {
                this.likeForm.post(this.route('post-like.store', this.post), {
                    preserveScroll: true,
                    onSuccess:()=>{}
                })
            },
            submitDislike() {
                this.dislikeForm.delete(this.route('post-like.destroy', this.post), {
                    preserveScroll: true,
                    onSuccess:()=>{}
                })
            }
        }
    }
</script>
