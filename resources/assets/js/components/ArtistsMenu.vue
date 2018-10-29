<template>

    <div class="artists-menu">

        <el-button plain @click="showFilters = !showFilters" style="margin-bottom: 20px;" class="hidden-sm-and-up">Filters</el-button>

        <el-form  v-if="showFilters" class="artists-menu-form">

            <el-form-item label="Filter by artist name" size="mini">
                <el-input v-model="artistFilters.artist" placeholder="Filter by artist name"></el-input>
            </el-form-item>

            <el-form-item label="Filter by country" size="mini">
                <el-select value="" v-model="artistFilters.country" filterable multiple collapse-tags
                           placeholder="Filter by country">
                    <el-option
                            v-for="country in countries"
                            :key="country.id"
                            :label="country.country_name"
                            :value="country.id">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="Filter by profession" size="mini">
                <el-select value="" v-model="artistFilters.profession" allow-create filterable multiple collapse-tags
                           placeholder="Filter by profession">
                    <el-option
                            v-for="(profession, key) in trans('profession')"
                            :key="key"
                            :label="profession"
                            :value="key">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="Filter by materials" size="mini">
                <el-select value="" v-model="artistFilters.medium" allow-create filterable multiple collapse-tags
                           placeholder="Filter by medium">
                    <el-option
                            v-for="(medium, key) in trans('medium')"
                            :key="key"
                            :label="medium"
                            :value="key">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="Filter by Art direction" size="mini">
                <el-select value="" v-model="artistFilters.direction" allow-create filterable multiple collapse-tags
                           placeholder="Filter by direction">
                    <el-option
                            v-for="(direction, key) in trans('direction')"
                            :key="key"
                            :label="direction"
                            :value="key">
                    </el-option>
                </el-select>
            </el-form-item>


            <el-button type="primary" style="margin-bottom: 20px;" size="mini" @click="setSearchQuery" plain>Filter</el-button>

            <el-button type="warning" size="mini" @click="clearFilters" plain>Clear filters</el-button>

        </el-form>



    </div>

</template>

<script>

    export default {

        data() {
            return {
                artistFilters: {
                    artist: '',
                    country: '',
                    profession: '',
                    medium: [],
                    direction: [],
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
                    this.artistFilters['artist'] = artist;
                }

                // Parse country from url
                let country = this.getQueryVariable('country');
                if (country) {
                    let countries = country.split(',');

                    countries = countries.map($country=> {
                        return Number($country);
                    });

                    this.artistFilters['country'] = countries
                }

                // Parse profession from url
                let profession = this.getQueryVariable('profession');
                if (profession) {
                    this.artistFilters['profession'] = profession.split(',');
                }

                // Parse medium from url
                let medium = this.getQueryVariable('medium');
                if (medium) {
                    this.artistFilters['medium'] = medium.split(',');
                }

                // Parse art direction
                let direction = this.getQueryVariable('direction');
                if (direction) {
                    this.artistFilters['direction'] = direction.split(',');
                }

            },
            setSearchQuery() {
                let query = '?';
                for (let filter in this.artistFilters) {
                    if(this.artistFilters[filter].length) {
                        query += filter + '=' + this.artistFilters[filter] + '&';
                    }
                }

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
                for (let filter in this.artistFilters) {
                    this.artistFilters[filter] = '';
                }

                this.setSearchQuery();
            }
        }
    }
</script>