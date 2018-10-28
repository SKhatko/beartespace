<template>
    <el-input-number v-if="artwork" size="mini" value="1" v-model="quantity" :min="1" name="qty"
                     :max="artwork.quantity"
                     style="margin-bottom: 20px;"></el-input-number>
</template>

<script>
    export default {
        props: {
            artwork_: {},
        },
        data() {
            return {
                quantity: 0,
                artwork: {},
            }
        },
        mounted() {
            if(this.artwork_) {
                this.artwork = JSON.parse(this.artwork_);
            }

            console.log(this.artwork);
        }
    }
</script>

<style scoped>

</style>