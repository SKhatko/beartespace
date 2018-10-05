<template>

    <div class="artwork-images">

        <el-button :icon="favoriteIconClass" class="artwork-images-favorite" circle
                   @click="$store.commit('toggleFavorites', artwork)"></el-button>

        <div class="artwork-images-carousel">

            <el-button plain class="artwork-images-zoom" circle @click="showArtworkImageDialog = !showArtworkImageDialog"><i
                    class="el-icon-zoom-in"></i>
            </el-button>

            <el-carousel trigger="click" indicator-position="outside" height="500px" :interval="0" @change="setActiveSlide">

                <el-carousel-item>
                    <div class="image">
                        <img :src="'/imagecache/height-500' + artwork.image_url" alt="">
                    </div>
                </el-carousel-item>

                <el-carousel-item v-for="image in artwork.images" :key="image.id">
                    <div class="image">
                        <img :src="'/imagecache/height-500' + image.url" alt="">
                    </div>
                </el-carousel-item>

            </el-carousel>

        </div>

        <el-dialog fullscreen :visible.sync="showArtworkImageDialog" center>
            <div style="text-align: center;">
                <img :src="'/imagecache/original' + activeImagePath"
                     alt="" style="max-height: 90vh;">
            </div>
        </el-dialog>

    </div>

</template>


<script>

    export default {

        props: {
            artwork_: {},
        },

        data() {
            return {
                showArtworkImageDialog: false,
                activeSlide: 0,
                artwork: {},
            }
        },

        mounted() {
            if (this.artwork_) {
                this.artwork = JSON.parse(this.artwork_);
            }

            console.log(this.artwork.images);
        },

        methods: {
            setActiveSlide(activeSlide) {
                this.activeSlide = activeSlide;
            }
        },
        computed: {
            favoriteIconClass() {
                if (this.$store.state.favoriteArtworks.find(artwork => {
                    return artwork.id === this.artwork.id
                })) {
                    return 'el-icon-star-on'
                }
                return 'el-icon-star-off'
            },
            activeImagePath() {
                if (this.activeSlide === 0) {
                    return this.artwork.image_url
                } else {
                    return this.artwork.images[--this.activeSlide].url;
                }
            }

        },
    }
</script>