<template>
    <form @submit.prevent="ignoreRequest">
        <jet-danger-button type="submit" class="text-xs">
            <fingerprint-spinner
                :animation-duration="1500"
                :size="20"
                class="text-white"
                v-if="loading"
            />
            <template v-else>
                Ignore
                <icon name="user-minus" class="w-4 h-4 fill-current ml-1"></icon>
            </template>
        </jet-danger-button>
    </form>
</template>

<script>
    import { FingerprintSpinner } from 'epic-spinners'
    import JetDangerButton from '@/Jetstream/DangerButton'
    export default {
        props: ['profile'],
        components: {
            FingerprintSpinner,
            JetDangerButton,
        },
        data() {
            return {
                loading: false
            }
        },
        methods: {
            ignoreRequest() {
                this.loading = true
                this.$inertia.get(this.route('friends.deny', this.profile.id, {
                    onSuccess:()=>{
                        Toast.fire({
                            icon: 'success',
                            title: 'Friend request successfully ignored!'
                        })
                        this.loading = false
                    }
                }))
            }
        }
    }
</script>
