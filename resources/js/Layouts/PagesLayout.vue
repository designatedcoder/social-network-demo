<template>
    <app-layout>
        <div class="lg:px-10">
            <div>
                <slot name="title"></slot>
            </div>
            <div class="mt-5">
                <slot></slot>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './AppLayout'
    export default {
        components: {
            AppLayout,
        }
    }
</script>
