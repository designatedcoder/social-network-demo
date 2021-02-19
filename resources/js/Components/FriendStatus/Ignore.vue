<template>
    <form @submit.prevent="ignoreRequest">
        <jet-danger-button type="submit" class="text-xs">
            Ignore
            <icon name="user-minus" class="w-4 h-4 fill-current ml-1"></icon>
        </jet-danger-button>
    </form>
</template>

<script>
    import JetDangerButton from '@/Jetstream/DangerButton'
    export default {
        props: ['profile'],
        components: {
            JetDangerButton,
        },
        methods: {
            ignoreRequest() {
                this.$inertia.get(this.route('friends.deny', this.profile.id, {
                    onSuccess:()=>{}
                }))
            }
        }
    }
</script>
