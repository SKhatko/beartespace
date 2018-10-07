<template>

    <div class="artworks-menu">

        <!--<el-button plain @click="showFilters = !showFilters" style="margin-bottom: 20px;">Filters</el-button>-->

        <el-form v-if="showFilters" style="margin-bottom: 20px;">

            <el-form-item label="Filter by artist name" size="mini">
                <el-input v-model="artworkFilters.artist" placeholder="Filter by artist name"></el-input>
            </el-form-item>

            <el-form-item label="Filter by artist title" size="mini">
                <el-input v-model="artworkFilters.artwork" placeholder="Filter by artwork title"></el-input>
            </el-form-item>

            <el-form-item label="Filter by category" size="mini">
                <el-select value="" v-model="artworkFilters.category" filterable multiple collapse-tags allow-create
                           placeholder="Filter by category">
                    <el-option
                            v-for="(category, key) in trans('category')"
                            :key="key"
                            :label="category"
                            :value="key">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="Filter by material" size="mini">
                <el-select value="" v-model="artworkFilters.medium" filterable multiple collapse-tags allow-create
                           placeholder="Filter by medium">
                    <el-option
                            v-for="(medium, key) in trans('medium')"
                            :key="key"
                            :label="medium"
                            :value="key">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="Filter by theme" size="mini">
                <el-select value="" v-model="artworkFilters.theme" filterable multiple collapse-tags allow-create
                           placeholder="Filter by theme">
                    <el-option
                            v-for="(theme, key) in trans('theme')"
                            :key="key"
                            :label="theme"
                            :value="key">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="Filter by direction" size="mini">
                <el-select value="" v-model="artworkFilters.direction" filterable multiple collapse-tags allow-create
                           placeholder="Filter by direction">
                    <el-option
                            v-for="(direction, key) in trans('direction')"
                            :key="key"
                            :label="direction"
                            :value="key">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="Filter by country" size="mini">
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

            <el-form-item label="Filter by shape" size="mini">
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

            <!--<el-form-item>-->

                <!--<el-select value="" v-model="artworkFilters.size" placeholder="Filter by size">-->
                    <!--<el-option :key="50" label="Up to 50cm" :value="50"></el-option>-->
                    <!--<el-option :key="100" label="Up to 100cm" :value="100"></el-option>-->
                    <!--<el-option :key="200" label="Up to 200cm" :value="200"></el-option>-->

                <!--</el-select>-->

            <!--</el-form-item>-->

            <el-form-item label="Filter by color" size="mini">
                <el-select value="" v-model="artworkFilters.color" filterable multiple collapse-tags
                           placeholder="Filter by color">
                    <el-option
                            v-for="(color, key) in trans('color')"
                            :key="key"
                            :label="color"
                            :value="key">
                        <span :style="{float: 'left', marginRight: '10px', width: '30px',height: '30px',backgroundColor: key}"></span> {{ color }}
                    </el-option>
                </el-select>
            </el-form-item>


            <el-form-item label="Price from" size="mini">
                <el-input-number v-model="artworkFilters.price_min" :step="100"></el-input-number>
            </el-form-item>

            <el-form-item label="Price max" size="mini">
                <el-input-number v-model="artworkFilters.price_max" :step="100"></el-input-number>
            </el-form-item>

            <el-button type="primary" size="mini" style="margin-bottom: 20px;" @click="setSearchQuery">Filter</el-button>

            <el-button @click="clearFilters" size="mini" type="warning" plain>Clear filters</el-button>

        </el-form>


    </div>

</template>

<script>

    export default {

        props: {},

        data() {
            return {
                artworkFilters: {
                    artist: '',
                    artwork: '',
                    medium: [],
                    category: [],
                    theme: [],
                    direction: [],
                    country: '',
                    shape: '',
                    size: '',
                    color: '',
                    price_min: '',
                    price_max: '',
                },

                countries: '',
                showFilters: true
            }
        },

        mounted() {

            axios.get('/api/countries').then(response => {
                this.countries = response.data;
            });

            console.log(window.location.search);
            if (window.location.search) {
                this.setFilters();
            }
        },

        methods: {
            setFilters() {

                // Parse artist name from url
                let artist = this.getQueryVariable('artist');
                if (artist) {
                    this.artworkFilters['artist'] = artist;
                }

                // Title name
                let artwork = this.getQueryVariable('artwork');
                if (artwork) {
                    this.artworkFilters['artwork'] = artwork;
                }

                let medium = this.getQueryVariable('medium');
                if (medium) {
                    this.artworkFilters['medium'] = medium.split(',');
                }

                let category = this.getQueryVariable('category');
                if (category) {
                    this.artworkFilters['category'] = category.split(',');
                }

                let theme = this.getQueryVariable('theme');
                if (theme) {
                    this.artworkFilters['theme'] = theme.split(',');
                }

                let direction = this.getQueryVariable('direction');
                if (direction) {
                    this.artworkFilters['direction'] = direction.split(',');
                }

                let country = this.getQueryVariable('country');
                if (country) {
                    let countries = country.split(',');

                    countries = countries.map($country => {
                        return Number($country);
                    });

                    this.artworkFilters['country'] = countries;
                }

                let shape = this.getQueryVariable('shape');
                if (shape) {
                    this.artworkFilters['shape'] = shape.split(',');
                }

                let color = this.getQueryVariable('color');
                if (color) {
                    this.artworkFilters['color'] = color.split(',');
                }

                let price_min = this.getQueryVariable('price_min');
                if (price_min) {
                    this.artworkFilters['price_min'] = price_min;
                }

                let price_max = this.getQueryVariable('price_max');
                if (price_max) {
                    this.artworkFilters['price_max'] = price_max;
                }

            },
            setSearchQuery() {
                let query = '?';
                for (let filter in this.artworkFilters) {
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
                // console.log('Query variable %s not found', variable);
            },
            clearFilters() {
                for (let filter in this.artworkFilters) {
                    this.artworkFilters[filter] = '';
                }

                this.setSearchQuery();
            }
        }
    }
</script>