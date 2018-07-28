<template>

    <div class="artists-menu">


        <el-form inline>
            <el-form-item>
                <el-select value="artist" v-model="artist" filterable placeholder="Select">
                    <el-option
                            v-for="item in artists_"
                            :key="item.id"
                            :label="item.name"
                            :value="item.id">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item>
                <el-button @click="getCheckedFilters">Show</el-button>

            </el-form-item>
        </el-form>


        <!--<el-tree-->
                <!--:data="artistFilters"-->
                <!--:props="defaultProps"-->
                <!--ref="artists"-->
                <!--node-key="key"-->
                <!--:default-expanded-keys="['artists']"-->
                <!--:default-checked-keys="['artist&#45;&#45;14']"-->
                <!--check-on-click-node-->
                <!--:expand-on-click-node="false"-->
                <!--accordion-->
                <!--empty-text="Empty text"-->
                <!--show-checkbox>-->
        <!--</el-tree>-->



    </div>

</template>

<script>

    export default {

        props: {
            'artists_': {}
        },

        data() {
            return {
                artist: 1,
                artistFilters: [],
                defaultProps: {
                    children: 'children',
                    label: 'label',
                    disabled: 'disabled',
                },

            }
        },

        mounted() {

            this.artistFilters.push({
                key: 'artists',
                label: this.trans('portal')['artists'],
                children: Object.values(this.artists_).map(function (artist) {
                    return {
                        key: 'artist--' + artist.id,
                        label: artist.name
                    }
                })
            });

            this.artistFilters.push({
                key: 'medium',
                label: this.trans('portal')['technique'],
                children: Object.entries(this.trans('medium')).map(function (item) {
                    return {
                        key: 'medium--' + item[0],
                        label: item[1],
                    }
                })
            })
        },

        methods: {
            getCheckedFilters() {
                console.log(this.$refs.artists.getCheckedKeys());
            }
        }
    }
</script>