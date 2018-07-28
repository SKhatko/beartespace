<template>

    <el-card class="artwork">

        <div class="artwork-top">
            <a :href="'/artwork/' + artwork.id" class="artwork-image">
                <img :src="artwork.images[0].url" :alt="artwork.images[0].name">
            </a>

            <div class="artwork-panel">

                <el-button icon="el-icon-star-off" class="artwork-panel-favourite" circle @click="$store.commit('toggleFavourites', artwork)"></el-button>
                <el-button icon="el-icon-goods" class="artwork-panel-cart" circle @click="$store.commit('toggleCart', artwork)"></el-button>

            </div>
        </div>

        <a :href="'/artwork/' + artwork.id" class="artwork-title">
            {{ artwork.title }}
        </a>

        <div class="artwork-bottom">
            <div class="artwork-info">
                <div class="h4">{{ artwork.user.name }}</div>
                <div class="h5">{{ artwork.user.country.country_name }}</div>
            </div>

            <!--<div class="artwork-price">-->
                <!--{{ currency($artwork->price) . optionalPrice($artwork->price) }}-->
            <!--</div>-->
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
                this.artwork = this.artwork_;
            }

        },

        methods: {}
    }
</script>