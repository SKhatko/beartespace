<template>

    <div class="app-artworks-block">

        <el-card class="artwork" v-for="artwork in artworks" shadow="hover" :key="artwork.id">

            <div class="artwork-top">
                <a :href="'/artwork/' + artwork.id" target="_blank" class="artwork-image">
                    <img :src="'/imagecache/fit-290/' + artwork.image_url">
                </a>

                <el-button :icon="favoriteIconClass(artwork)" class="artwork-favorite" circle
                           @click="$store.commit('toggleFavorites', artwork)"></el-button>
            </div>

            <div class="artwork-info">
                <a :href="'/artwork/' + artwork.id" target="_blank" class="artwork-name">
                    {{ artwork.name }}
                </a>

                <div class="artwork-price">
                    {{ artwork.formatted_price }}
                </div>
            </div>


        </el-card>
    </div>

</template>


<script>

    export default {

        props: {
            artworks_: {},
        },

        data() {
            return {
                artworks: {},
            }
        },

        mounted() {
            if (this.artworks_) {
                this.artworks = JSON.parse(this.artworks_);
            }

            // console.log(this.artworks);

        },

        methods: {
            favoriteIconClass(item) {
                if (this.$store.state.favoriteArtworks.find(artwork => {
                    return artwork.id === item.id
                })) {
                    return 'el-icon-star-on'
                }
                return 'el-icon-star-off'
            },
        },
        computed: {},
    }
</script>