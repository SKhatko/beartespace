<template>

    <el-card class="app-dashboard-artworks-block">

        <div slot="header" class="app-dashboard-artworks-block__header">
            <el-input v-model="filter" clearable @input="filterArtworks" style="max-width: 290px;margin-bottom: 10px;" placeholder="Filter"></el-input>
                <a href="/dashboard/artworks/create" class="el-button el-button--default el-button--success" style="margin-bottom: 10px;">Upload
                    Artwork</a>
        </div>

        <el-row :gutter="20">

            <el-col :xs="12" :sm="8" :md="6" class="app-dashboard-artworks-block__artwork" v-for="artwork in artworks" :key="artwork.id" style="margin-bottom: 20px;">

                <a :href="artwork.url" class="app-dashboard-artworks-block__image">
                    <img :src="'/imagecache/fit-290' + artwork.image_url" alt="">
                </a>

                <div class="app-dashboard-artworks-block__manage">

                    <div class="app-dashboard-artworks-block__name">{{ artwork.name }}</div>

                    <!--<div class="block-artwork-price">{{ artwork.formatted_price }}</div>-->

                    <a :href="'/dashboard/artworks/' + artwork.id + '/edit'"
                       class="el-button el-button--default el-button--mini" style="margin-right: 10px;">Edit</a>

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
                filter: '',
            }

        },

        mounted() {
            if (this.artworks_) {
                this.artworks = JSON.parse(this.artworks_);
            }

            console.log(this.artworks);
        },
        methods: {
            filterArtworks() {
                this.artworks = JSON.parse(this.artworks_).filter(artwork => {
                    return artwork.name.toLowerCase().indexOf(this.filter.toLowerCase()) >= 0;
                })
            },
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