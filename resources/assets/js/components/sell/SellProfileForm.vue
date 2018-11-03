<template>

    <div>
        <span @click="showArtistForm">
            <slot name="artist"></slot>
        </span>

        <span @click="showGalleryForm">
            <slot name="gallery"></slot>
        </span>

        <el-dialog :visible.sync="dialogVisible" width="600px">
            <profile-form :request_seller_type_="requestSellerType"></profile-form>
        </el-dialog>
    </div>


</template>

<script>


    export default {
        props: {
            authorization_: '',
        },
        data() {
            return {
                dialogVisible: false,
                requestSellerType: '',
            }
        },
        mounted() {
        },
        methods: {
            showArtistForm() {
                this.requestSellerType = 'artist';
                this.dialogVisible = true
            },
            showGalleryForm() {
                this.requestSellerType = 'gallery';
                this.dialogVisible = true
            }
        }
    }
</script>

