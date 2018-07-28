<template>

    <aside>

        <h2 class="h2">Menu</h2>

        <el-tree
                :data="artworkFilters"
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

        props: {},

        data() {
            return {
                artworkFilters: [
                    //     {
                    //     key: 1,
                    //     label: 'Category',
                    //     children: [{
                    //         key: 3,
                    //         label: 'Painting',
                    //     }, {
                    //         key: 2,
                    //         label: 'Sculpture'
                    //     }]
                    // }
                ],
                defaultProps: {
                    children: 'children',
                    label: 'label',
                    disabled: 'disabled',
                },

            }
        },

        mounted() {
            let filters = ['category', 'direction', 'medium', 'theme', 'color'];

            filters.map(filter => {
                // console.log(filter);

                this.artworkFilters.push({
                    key: filter,
                    label: this.trans('portal')[filter],
                    children: Object.entries(this.trans(filter)).map(function (item) {
                        // console.log(item);
                        return {
                            key: filter + '--' + item[0],
                            label: item[1],
                        }
                    })
                })
            });
        },

        methods: {}
    }
</script>