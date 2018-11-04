<template>

    <el-card class="app-dashboard-artworks-block">

        <el-row :gutter="20">

            <el-col :xs="12" :sm="8" :md="6" class="block-artwork-new">
                <a href="/dashboard/artworks/create" class="el-button el-button--default">Upload
                    Artwork</a>
            </el-col>

            <el-col :xs="12" :sm="8" :md="6" class="block-artwork" v-for="artwork in artworks" :key="artwork.id" style="margin-bottom: 20px;">

                <a :href="artwork.url" class="block-artwork-image">
                    <img :src="'/imagecache/fit-290' + artwork.image_url" alt="">
                </a>

                <div class="block-artwork-manage">

                    <div class="block-artwork-name">{{ artwork.name }}</div>

                    <!--<div class="block-artwork-price">{{ artwork.formatted_price }}</div>-->

                    <!--<a :href="'/dashboard/artwork/' + artwork.id + '/edit'"-->
                       <!--class="el-button el-button&#45;&#45;default el-button&#45;&#45;mini" style="margin-right: 10px;">Edit</a>-->

                    <!--<el-checkbox :disabled="artwork.sold_at ? true : false" value="artwork.sold_at"-->
                                 <!--style="margin-right: 10px;"-->
                                 <!--@change="markArtworkAsSold(artwork)">-->
                        <!--Mark Sold-->
                    <!--</el-checkbox>-->
                </div>


                <!--<el-button type="text" v-if="artwork.available">-->
                <!--Disable-->
                <!--</el-button>-->
                <!--<el-button v-else type="text" @click="enableArtwork(artwork)">-->
                <!--Enable-->
                <!--</el-button>-->


            </el-col>

        </el-row>


    </el-card>

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
            markArtworkAsSold(artwork) {

                this.$prompt('Where did you sell your artwork ', 'Mark as sold', {
                    confirmButtonText: 'Confirm',
                    cancelButtonText: 'Cancel',
                    inputPattern: /^\S+$/,
                    inputErrorMessage: 'Enter the source where you sold artwork',
                }).then(result => {

                    console.log(result);
                    artwork.sold_by = result.value;
                    artwork.sold_at = result.action;

                    axios.post('/api/artwork/', artwork)
                        .then((response) => {
                            console.log(response.data);

                            this.artworks = this.artworks.map(item => {
                                if (item.id === response.data.data.id) {
                                    return response.data.data;
                                } else {
                                    return item
                                }
                            });
                        }).catch(error => {
                        console.log(error.response);
                    });
                }).catch(error => {
                    console.log(error);
                })
            }
        }

    }
</script>

<style scoped>

</style>