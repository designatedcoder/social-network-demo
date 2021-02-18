<template>
    <div class="flex mt-5 sm:mt-0">
        <template v-if="$page.props.user.id != profile.id">
            <form @submit.prevent="addFriend">
                <blue-button type="submit" class="text-xs">
                    Add Friend
                    <icon name="user-plus" class="w-4 h-4 fill-current ml-1"></icon>
                </blue-button>
            </form>
        </template>
    </div>
</template>

<script>
    import BlueButton from '@/Components/Buttons/BlueButton'
    export default {
        props: ['profile'],
        components: {
            BlueButton,
        },
        data() {
            return {
                addFriendForm: this.$inertia.form({
                    user: this.profile
                }),
            }
        },
        methods: {
            addFriend() {
                this.addFriendForm.post(this.route('friends.store', this.profile.id), {
                    preserveScroll: true,
                    onSuccess: ()=>{},
                })
            },
        }
    }
</script>
