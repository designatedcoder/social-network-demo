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

        <form @submit.prevent="submit" class="w-full">
            <div>
                <textarea name="post" rows="3" class="border rounded px-2 py-2 w-full" :placeholder="`Post something ${$page.props.user.username} ...`" v-model="form.body"></textarea>
            </div>
            <div class="flex justify-between my-3">
                <div>
                    <jet-input-error :message="form.errors.body" class="mt-2" v-if="form.errors.body"></jet-input-error>
                </div>
                <div>
                    <blue-button type="submit" class="text-xs" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        <fingerprint-spinner
                            :animation-duration="1500"
                            :size="20"
                            class="text-white"
                            v-if="form.processing"
                        />
                        <span v-else>Post</span>
                    </blue-button>
                </div>
            </div>
        </form>

        <combined-posts :posts="combinedPosts.data"></combined-posts>
    </pages-layout>
</template>

<script>
    import { FingerprintSpinner } from 'epic-spinners'
    import BlueButton from '@/Components/Buttons/BlueButton'
    import CombinedPosts from '@/Components/PostComment/CombinedPosts'
    import JetInputError from '@/Jetstream/InputError'
    import PagesLayout from '@/Layouts/PagesLayout'
    export default {
        props: ['combinedPosts'],
        components: {
            BlueButton,
            CombinedPosts,
            FingerprintSpinner,
            JetInputError,
            PagesLayout,
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
