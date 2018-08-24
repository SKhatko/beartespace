<template>

    <div class="app-settings" >
        <div class="h2">Main Settings</div>

        <el-form>

            <el-form-item label="Artists of the week">
                <el-select v-model="settings.artists_of_the_week" filterable multiple placeholder="Select Artists">
                    <el-option
                            v-for="artist in artists"
                            :key="artist.id"
                            :label="artist.name"
                            :value="artist.id">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="Artworks of the week">
                <el-select v-model="settings.artworks_of_the_week" filterable multiple placeholder="Select Artists">
                    <el-option
                            v-for="artwork in artworks"
                            :key="artwork.id"
                            :label="artwork.title"
                            :value="artwork.id">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-button @click="save">Save Settings</el-button>
        </el-form>
    </div>


</template>

<script>

    export default {

        props: {
            artists_: {},
            settings_: {},
            artworks_: {}
        },

        data() {
            return {
                artists: {},
                settings: {},
                artworks: {}
            }
        },

        mounted() {

            if (this.artists_) {
                this.artists = JSON.parse(this.artists_);
            }
            if (this.settings_) {
                this.settings = JSON.parse(this.settings_);
            }

            if (this.artworks_) {
                this.artworks = JSON.parse(this.artworks_);
            }

            console.log(this.settings);
        },

        methods: {

            save() {

                axios.post('/api/settings', this.settings)
                    .then((response) => {
                        if (response.data) {
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