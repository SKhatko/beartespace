<template>

    <div class="app-artworks-menu">

        <el-form inline>

            <el-form-item>
                <el-input v-model="artworkFilters.artist" placeholder="Filter by artist name"></el-input>
            </el-form-item>

            <el-form-item>
                <el-input v-model="artworkFilters.artwork" placeholder="Filter by artwork title"></el-input>
            </el-form-item>

            <el-form-item>

                <el-select value="" v-model="artworkFilters.category" filterable multiple collapse-tags
                           placeholder="Filter by category">
                    <el-option
                            v-for="(category, key) in trans('category')"
                            :key="key"
                            :label="category"
                            :value="key">
                    </el-option>
                </el-select>

            </el-form-item>

            <el-form-item>

                <el-select value="" v-model="artworkFilters.medium" filterable multiple collapse-tags
                           placeholder="Filter by medium">
                    <el-option
                            v-for="(medium, key) in trans('medium')"
                            :key="key"
                            :label="medium"
                            :value="key">
                    </el-option>
                </el-select>

            </el-form-item>

            <el-form-item>

                <el-select value="" v-model="artworkFilters.theme" filterable multiple collapse-tags
                           placeholder="Filter by theme">
                    <el-option
                            v-for="(theme, key) in trans('theme')"
                            :key="key"
                            :label="theme"
                            :value="key">
                    </el-option>
                </el-select>

            </el-form-item>

            <el-form-item>

                <el-select value="" v-model="artworkFilters.direction" filterable multiple collapse-tags
                           placeholder="Filter by direction">
                    <el-option
                            v-for="(direction, key) in trans('direction')"
                            :key="key"
                            :label="direction"
                            :value="key">
                    </el-option>
                </el-select>

            </el-form-item>

            <el-form-item>

                <el-select value="" v-model="artworkFilters.country" filterable multiple collapse-tags
                           placeholder="Filter by country">
                    <el-option
                            v-for="country in countries"
                            :key="country.id"
                            :label="country.country_name"
                            :value="country.id">
                    </el-option>
                </el-select>

            </el-form-item>

            <el-form-item>

                <el-select value="" v-model="artworkFilters.shape" filterable multiple collapse-tags
                           placeholder="Filter by shape">
                    <el-option
                            v-for="(shape, key) in trans('shape')"
                            :key="key"
                            :label="shape"
                            :value="key">
                    </el-option>
                </el-select>

            </el-form-item>

            <el-form-item>

                <el-select value="" v-model="artworkFilters.size" placeholder="Filter by size">
                    <el-option :key="50" label="Up to 50cm" :value="50"></el-option>
                    <el-option :key="100" label="Up to 100cm" :value="100"></el-option>
                    <el-option :key="200" label="Up to 200cm" :value="200"></el-option>

                </el-select>

            </el-form-item>

            <el-form-item>

                <el-select value="" v-model="artworkFilters.color" filterable multiple collapse-tags
                           placeholder="Filter by color">
                    <el-option
                            v-for="(color, key) in trans('color')"
                            :key="key"
                            :label="color"
                            :value="key">
                    </el-option>
                </el-select>

            </el-form-item>


            <el-form-item>

                <el-select value="" v-model="artworkFilters.price" placeholder="Filter by price">
                    <el-option :key="7000" label="Up to 7000" :value="7000"></el-option>
                    <el-option :key="15000" label="Up to 15000" :value="15000"></el-option>
                    <el-option :key="30000" label="Up to 30000" :value="30000"></el-option>

                </el-select>

            </el-form-item>



        </el-form>


        <el-button style="margin-bottom: 20px;">Filter</el-button>

    </div>

</template>

<script>

    export default {

        props: {
            countries_: {}
        },

        data() {
            return {
                artworkFilters: {

                    // Free
                    artist: '',
                    artwork: '',
                    medium: [],
                    category: [],

                    // Basic
                    theme: [],
                    direction: [],

                    // Vip
                    country: '',
                    shape: '',
                    size: '',
                    color: '',
                    price: '',
                },

                // TODO countries
                countries: '',

            }
        },

        mounted() {
            let filters = ['category', 'direction', 'medium', 'theme', 'color'];

            if (this.countries_) {
                this.countries = JSON.parse(this.countries_);
            }

            // filters.map(filter => {
            //     // console.log(filter);
            //
            //     this.artworkFilters.push({
            //         key: filter,
            //         label: this.trans('portal')[filter],
            //         children: Object.entries(this.trans(filter)).map(function (item) {
            //             // console.log(item);
            //             return {
            //                 key: filter + '--' + item[0],
            //                 label: item[1],
            //             }
            //         })
            //     })
            // });
        },

        methods: {}
    }
</script>