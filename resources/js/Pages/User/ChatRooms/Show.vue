<template>
    <pages-layout>
        <template #title>
            <div class="flex flex-col">
                <inertia-link :href="route('chat-rooms.index')" class="flex text-gray-800">
                    <icon name="angle-left" class="w-3 h-3 fill-current"></icon>
                    <span class="font-semibold text-lg capitalize underline ml-2">Back</span>
                </inertia-link>
                <div class="flex justify-between items-center mt-5">
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight">
                        Welcome to: {{ room.name }}
                    </h3>
                    <h4>{{ room.active }} active users</h4>
                </div>

                <div class="flex space-x-4 mt-5">
                    <div class="flex-shrink-0 rounded-md border border-gray-300 h-128">

                    </div>
                    <div class="flex-1 rounded-md border border-gray-300 flex flex-col h-128">
                        <chat-box :messages="messages"></chat-box>
                        <chat-input :method="submitMessage" :form="form" :item="room"></chat-input>
                    </div>
                </div>
            </div>
        </template>
    </pages-layout>
</template>

<script>
    import ChatBox from '@/Components/Chat/ChatBox'
    import ChatInput from '@/Components/Chat/ChatInput'
    import PagesLayout from '@/Layouts/PagesLayout'
    export default {
        props: ['room', 'messages'],
        components: {
            ChatBox,
            ChatInput,
            PagesLayout,
        },
        data() {
            return {
                form: this.$inertia.form({
                    body: this.body,
                    room: this.room
                })
            }
        },
        mounted() {
            this.connect()
        },
        methods: {
            submitMessage() {
                this.form.post(this.route('chat-rooms.store', this.room), {
                    preserveScroll: true,
                    onSuccess:() => {
                        this.scrollToBottom()
                        this.form.body = null
                    }
                })
            },
            connect() {
                Echo.private(`chat.${this.room.id}`)
                    .listen('NewChatMessageEvent', (e) => {
                        let newMessage = {
                            body: e.message.body,
                            user: e.user
                        }
                        this.messages.push(newMessage)
                    })
            }
        }
    }
</script>
