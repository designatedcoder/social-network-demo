<template>
    <div>
        <div v-for="(post, key) in posts" :key="key">
            <post-item :post="post"></post-item>
        </div>
    </div>
</template>

<script>
    import PostItem from './PostItem'
    export default {
        props: ['posts'],
        components: {
            PostItem,
        }
    }
</script>
