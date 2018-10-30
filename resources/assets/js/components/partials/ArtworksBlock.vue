<template>

    <div class="app-artworks-block" v-if="artworks.length">

        <div class="app-artworks-block__header">
            <slot name="header"></slot>
        </div>

        <el-row :gutter="20" class="app-artworks-block__row">
            <el-col :xs="12" :sm="6" :md="6" v-for="artwork in artworks" :key="artwork.id" class="app-artworks-block__col">
                <el-card shadow="hover">
                    <div class="app-artworks-block__artwork">
                        <div class="app-artworks-block__artwork-top">
                            <a :href="'/artwork/' + artwork.id" class="app-artworks-block__artwork-image">
                                <img :src="'/imagecache/fit-290' + artwork.image_url">
                            </a>

                            <el-button :icon="favoriteIconClass(artwork)" class="app-artworks-block__artwork-favorite" circle
                                       @click="$store.commit('toggleFavorites', artwork)"></el-button>
                        </div>

                        <div class="app-artworks-block__artwork-info">
                            <a :href="'/artwork/' + artwork.id" class="app-artworks-block__artwork-name">
                                {{ artwork.name }}
                            </a>

                            <a :href="artwork.user.url">{{ artwork.user.name }}</a>

                            <div class="app-artworks-block__artwork-price">
                                {{ artwork.formatted_price }}
                            </div>
                        </div>
                    </div>

                </el-card>
            </el-col>
        </el-row>

        <div class="app-artworks-block__footer">
            <slot name="footer"></slot>
        </div>

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

            console.log(this.artworks);

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