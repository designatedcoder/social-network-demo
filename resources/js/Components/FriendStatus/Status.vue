<template>
    <div class="flex mt-5 sm:mt-0">
        <template v-if="friendRequestRecievedFrom">
            <accept :profile="profile"></accept>
            <ignore :profile="profile" class="ml-3"></ignore>
        </template>
        <template v-else-if="friendRequestSentTo">
            <h3 class="font-semibold text-md text-gray-800 leading-tight">
                Pending
            </h3>
        </template>
        <template v-else-if="isFriendsWith">
            <form @submit.prevent="deleteFriend">
                <jet-danger-button type="submit">
                    Unfriend
                    <icon name="user-minus" class="w-4 h-4 fill-current ml-1"></icon>
                </jet-danger-button>
            </form>
        </template>
        <template v-else-if="$page.props.user.id != profile.id">
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
    import Accept from './Accept'
    import BlueButton from '@/Components/Buttons/BlueButton'
    import Ignore from './Ignore'
    import JetDangerButton from '@/Jetstream/DangerButton'
    export default {
        props: ['profile', 'isFriendsWith', 'friendRequestSentTo', 'friendRequestRecievedFrom'],
        components: {
            Accept,
            BlueButton,
            Ignore,
            JetDangerButton,
        },
        data() {
            return {
                addFriendForm: this.$inertia.form({
                    user: this.profile
                }),
                deleteFriendForm: this.$inertia.form({
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
            deleteFriend() {
                this.deleteFriendForm.delete(this.route('friends.destroy', this.profile.id), {
                    preserveScroll: true,
                    onSuccess: ()=>{},
                })
            },
        }
    }
</script>
