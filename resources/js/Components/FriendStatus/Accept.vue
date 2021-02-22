<template>
    <form @submit.prevent="acceptFriend">
        <green-button type="submit" class="text-xs">
            <fingerprint-spinner
                :animation-duration="1500"
                :size="20"
                class="text-white"
                v-if="loading"
            />
            <template v-else>
                Accept
                <icon name="user-plus" class="w-4 h-4 fill-current ml-1"></icon>
            </template>
        </green-button>
    </form>
</template>

<script>
    import { FingerprintSpinner } from 'epic-spinners'
    import GreenButton from '@/Components/Buttons/GreenButton'
    export default {
        props: ['profile'],
        components: {
            FingerprintSpinner,
            GreenButton,
        },
        data() {
            return {
                acceptFriendForm: this.$inertia.form({
                    user: this.profile
                }),
                loading: false
            }
        },
        methods: {
            acceptFriend() {
                this.loading = true
                this.acceptFriendForm.patch(this.route('friends.update', this.profile.id), {
                    preserveScroll: true,
                    onSuccess:()=>{
                        Toast.fire({
                            icon: 'success',
                            title: 'Successfully accepted request!'
                        })
                        this.loading = false
                    }
                })
            }
        }
    }
</script>
