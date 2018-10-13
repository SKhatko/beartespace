<template>
    <div class="artworks">
        <el-card>

            <a href="/dashboard/artwork/create" class="el-button el-button--default" style="margin-bottom: 20px;">Upload Artwork</a>

            <div class="artwork" v-for="artwork in artworks" v-if="artwork">

                <a :href="'/artwork/' + artwork.id" class="artwork-image" target="_blank">
                    <img :src="'/imagecache/fit-100' + artwork.image_url" alt="">
                </a>

                <a :href="'/artwork/' + artwork.id" target="_blank" class="artwork-info">
                    <div class="artwork-name">{{ artwork.name }}</div>
                    <div class="artwork-artist">{{ artwork.made_by }}</div>
                    <div class="artwork-status">{{ artwork.statusString }}</div>
                </a>

                <div class="artwork-manage">

                    <div class="artwork-qty">{{ artwork.quantity }} pc</div>

                    <div class="artwork-price">{{ artwork.formatted_price }}</div>

                    <a :href="'/dashboard/artwork/edit/' + artwork.id"
                       class="el-button el-button--default el-button--mini" style="margin-right: 10px;">Edit</a>

                    <el-checkbox :disabled="artwork.sold_at ? true : false" value="artwork.sold_at" style="margin-right: 10px;"
                                 @change="markArtworkAsSold(artwork)">
                        Mark Sold
                    </el-checkbox>
                </div>



                <!--<el-button type="text" v-if="artwork.available">-->
                    <!--Disable-->
                <!--</el-button>-->
                <!--<el-button v-else type="text" @click="enableArtwork(artwork)">-->
                    <!--Enable-->
                <!--</el-button>-->


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