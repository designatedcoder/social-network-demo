<template>
    <pages-layout>
        <template #title>
            <div class="flex justify-between items-center w-full">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <img :src="$page.props.user.profile_photo_url" :alt="$page.props.user.username" class="h-8 w-8 rounded-full object-cover">
                    <span class="capitalize ml-3">Dashboard</span>
                </h2>
            </div>
        </template>

        <post-form :method="submit" :form="form" :text="'Post'"></post-form>

        <suggestion-block :suggestions="suggestions"></suggestion-block>

        <combined-posts :posts="combinedPosts.data"></combined-posts>
    </pages-layout>
</template>

<script>
    import CombinedPosts from '@/Components/PostComment/CombinedPosts'
    import PagesLayout from '@/Layouts/PagesLayout'
    import PostForm from '@/Components/PostComment/PostForm'
    import SuggestionBlock from '@/Components/SuggestionBlock'
    export default {
        props: ['combinedPosts', 'suggestions'],
        components: {
            CombinedPosts,
            PagesLayout,
            PostForm,
            SuggestionBlock,
        },
        data() {
            return {
                form: this.$inertia.form({
                    user_id: this.$page.props.user.id,
                    body: this.body
                })
            }
        },
        methods: {
            submit() {
                this.form.post(this.route('posts.store'), {
                    preserveScroll: true,
                    onSuccess:()=> {
                        Toast.fire({
                            icon: 'success',
                            title: 'Your post has successfully been published!',
                        }),
                        this.form.body = null
                    }
                })
            }
        }
    }
</script>
