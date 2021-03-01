<template>
    <div>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        mounted() {
            window.addEventListener('scroll', _.debounce((e) =>{
                let pixelsFromBottom = document.documentElement.offsetHeight - document.documentElement.scrollTop - window.innerHeight
                if(pixelsFromBottom < 200) {
                    this.$emit('loadMore')
                }
            }, 100))
        }
    }
</script>