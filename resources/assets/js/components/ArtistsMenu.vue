<template>

    <aside>

        <h2 class="h2">Menu</h2>

        <el-tree
                :data="artistFilters"
                :props="defaultProps"
                node-key="key"
                :default-expanded-keys="['category']"
                :default-checked-keys="['category--painting']"
                check-on-click-node
                :expand-on-click-node="false"
                accordion
                show-checkbox>
        </el-tree>

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
                        key: artist.id,
                        label: artist.name,
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

        methods: {}
    }
</script>