<template>

    <el-card class="artwork" v-if="artwork">

        <div class="artwork-top">
            <a :href="'/artwork/' + artwork.id" class="artwork-image" v-if="artwork.image">
                <img :src="'/imagecache/original/' + artwork.image_url" :alt="artwork.image.name">
            </a>

            <div class="artwork-panel">

                <el-button :icon="favouriteIconClass" class="artwork-panel-favourite" circle
                           @click="$store.commit('toggleFavourites', artwork)"></el-button>
                <el-button icon="el-icon-goods" class="artwork-panel-cart" circle
                           @click="$store.commit('toggleCart', artwork)"></el-button>

            </div>
        </div>

        <a :href="'/artwork/' + artwork.id" class="artwork-title">
            {{ artwork.title }}
        </a>

        <div class="artwork-bottom">
            <div class="artwork-info" v-if="artwork.user && artwork.user.country">
                <div class="h4">{{ artwork.user.name }}</div>
                <div class="h5">{{ artwork.user.country.country_name }}</div>
            </div>

            <div class="artwork-price">
                {{ artwork.formatted_price }}
            </div>
        </div>

    </el-card>

</template>


<script>

    export default {

        props: {
            artwork_: {},
        },

        data() {
            return {
                artwork: {},
            }
        },

        mounted() {
            if (this.artwork_) {
                this.artwork = JSON.parse(this.artwork_);
            }
        },

        methods: {},
        computed: {
            favouriteIconClass() {

                if (this.$store.state.favouriteArtworks.find(artwork => {
                    return artwork.id === this.artwork.id
                })) {
                    return 'el-icon-star-on'
                }
                return 'el-icon-star-off'

            },

            cartIconClass() {

                if (this.$store.state.cart.find(artwork => {
                    return artwork.id === this.artwork.id
                })) {
                    return 'el-icon-star-on'
                }
                return 'el-icon-star-off'

            }
        },
    }
</script>