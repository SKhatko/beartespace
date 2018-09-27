<template>

    <el-card class="artwork" v-if="artwork" shadow="hover">

        <div class="artwork-top">
            <a :href="'/artwork/' + artwork.id" target="_blank" class="artwork-image">
                <img :src="'/imagecache/original/' + artwork.image_url">
            </a>

            <div class="artwork-panel">

                <el-button :icon="favoriteIconClass" class="artwork-panel-favorite" circle
                           @click="$store.commit('toggleFavorites', artwork)"></el-button>
                <el-button class="artwork-panel-cart" circle :type="artworkInShoppingCartType"
                           @click="$store.commit('toggleShoppingCart', artwork)"><i class="el-icon-goods"></i>
                </el-button>

            </div>
        </div>

        <a :href="'/artwork/' + artwork.id" target="_blank" class="artwork-name">
            {{ artwork.name }}
        </a>

        <div class="artwork-bottom">
            <div class="artwork-info" v-if="artwork.user && artwork.user.country">
                <div class="artwork-artist">{{ artwork.user.name }}</div>
            </div>

            <div class="artwork-price">
                {{ artwork.formatted_price }}
                <!--<el-button><a :href="'/cart/item/' + artwork.id + '/buy-now'">Buy Now</a></el-button>-->
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
            favoriteIconClass() {
                if (this.$store.state.favoriteArtworks.find(artwork => {
                    return artwork.id === this.artwork.id
                })) {
                    return 'el-icon-star-on'
                }
                return 'el-icon-star-off'
            },
            artworkInShoppingCartType() {

                if (this.$store.state.shoppingCart.find(item => {
                    return item.id === this.artwork.id
                })) {
                    return 'primary'
                }
                return ''
            },

        },
    }
</script>