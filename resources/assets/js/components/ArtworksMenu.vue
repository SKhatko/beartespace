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

            <el-button style="margin-bottom: 20px;" @click="setSearchQuery">Filter</el-button>


        </el-form>


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

            if (this.countries_) {
                this.countries = JSON.parse(this.countries_);
            }

            console.log(window.location.search);
            if(window.location.search) {
                this.setFilters();
            }
        },

        methods: {
            setFilters() {
                for(let filter in this.artworkFilters) {
                    console.log(filter);
                    this.artworkFilters[filter] = this.getQueryVariable(filter);
                }

            },
            setSearchQuery() {
                let query = '?';
                for(let filter in this.artworkFilters) {
                    query += filter + '=' + this.artworkFilters[filter] + '&';
                    console.log(filter);
                }
                console.log(query);

                window.location.search = query;
            },
            getQueryVariable(variable) {
                let query = window.location.search.substring(1);
                let vars = query.split('&');
                for (let i = 0; i < vars.length; i++) {
                    let pair = vars[i].split('=');
                    if (decodeURIComponent(pair[0]) === variable) {
                        return decodeURIComponent(pair[1]);
                    }
                }
                console.log('Query variable %s not found', variable);
            }
        }
    }
</script>