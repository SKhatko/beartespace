<template>

    <aside>

        <h2 class="h2">Menu</h2>

        <el-tree
                :data="artistFilters"
                :props="defaultProps"
                ref="artists"
                node-key="key"
                :default-expanded-keys="['artists']"
                :default-checked-keys="['artist--14']"
                check-on-click-node
                :expand-on-click-node="false"
                accordion
                empty-text="Empty text"
                show-checkbox>
        </el-tree>

        <el-button @click="getCheckedFilters">Show</el-button>


    </aside>

</template>

<script>

    export default {

        props: {
            'artists_': {}
        },

        data() {
            return {
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