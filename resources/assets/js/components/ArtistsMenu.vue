<template>

    <div class="artists-menu">


        <el-form inline>

            <el-form-item>
                <el-input v-model="artistFilters.artist" placeholder="Filter by artist name"></el-input>
            </el-form-item>

            <el-form-item v-if="artistFilters.artist">
                <el-button @click="filterArtists">Show</el-button>
            </el-form-item>
        </el-form>



    </div>

</template>

<script>

    export default {

        props: {
            'artists_': {}
        },

        data() {
            return {
                artistFilters: {
                    artist: '',
                },


            }
        },

        mounted() {



        },

        methods: {
            filterArtists() {

            }

        }
    }
</script>