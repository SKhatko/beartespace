<template>

    <el-row gutter="20" class="app-artworks-block">
        <el-col :xs="12" :sm="6" :md="6" v-for="artwork in artworks" :key="artwork.id" class="block">
            <el-card shadow="hover">

                <div class="block-top">
                    <a :href="'/artwork/' + artwork.id" target="_blank" class="block-image">
                        <img :src="'/imagecache/fit-290' + artwork.image_url">
                    </a>

                    <el-button :icon="favoriteIconClass(artwork)" class="block-favorite" circle
                               @click="$store.commit('toggleFavorites', artwork)"></el-button>
                </div>

                <div class="block-info">
                    <a :href="'/artwork/' + artwork.id" target="_blank" class="block-name">
                        {{ artwork.name }}
                    </a>

                    <div class="block-price">
                        {{ artwork.formatted_price }}
                    </div>
                </div>


            </el-card>

        </el-col>
    </el-row>

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