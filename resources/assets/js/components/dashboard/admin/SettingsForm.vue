<template>

    <el-card>
        <div class="h2">Main Settings</div>

        <el-form>

            <template v-for="option in options">

                <el-form-item label="Artists of the week" v-if="option.name === 'artists_of_the_week'">
                    <el-select v-model="option.json_value" filterable multiple placeholder="Select Artists">
                        <el-option
                                v-for="artist in artists"
                                :key="artist.id"
                                :label="artist.name"
                                :value="artist.id">
                        </el-option>
                    </el-select>
                </el-form-item>

                <el-form-item label="Artworks of the week" v-if="option.name === 'artworks_of_the_week'">
                    <el-select v-model="option.json_value" filterable multiple placeholder="Select Artists">
                        <el-option
                                v-for="artwork in artworks"
                                :key="artwork.id"
                                :label="artwork.name"
                                :value="artwork.id">
                        </el-option>
                    </el-select>
                </el-form-item>


            </template>




            <el-button @click="save">Save Settings</el-button>
        </el-form>
    </el-card>
</template>

<script>

    export default {

        props: {
            artists_: {},
            options_: {},
            artworks_: {}
        },

        data() {
            return {
                artists: {},
                options: {},
                artworks: {}
            }
        },

        mounted() {

            if (this.artists_) {
                this.artists = JSON.parse(this.artists_);
            }
            if (this.options_) {
                this.options = JSON.parse(this.options_);
            }

            if (this.artworks_) {
                this.artworks = JSON.parse(this.artworks_);
            }

            console.log(this.options);
        },

        methods: {

            save() {

                axios.post('/api/settings', this.options)
                    .then((response) => {
                        if (response.data) {
                            this.options = response.data.data;
                            console.log(response.data);
                            this.$message({
                                showClose: true,
                                message: response.data.message,
                                type: response.data.status
                            });
                        } else {
                            console.log(response.data);
                        }
                    });
            }
        }
    }
</script>