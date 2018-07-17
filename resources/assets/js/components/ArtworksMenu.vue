<template>

    <aside>

        <h2 class="h2">Menu</h2>

        <el-tree
                :data="artworkFilters"
                :props="defaultProps"
                node-key="id"
                :default-expanded-keys="[2, 3]"
                :default-checked-keys="[5]"
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
                //     id: 1,
                //     label: 'Category',
                //     children: [{
                //         id: 3,
                //         label: 'Painting',
                //     }, {
                //         id: 2,
                //         label: 'Sculpture'
                //     }]
                // },{
                //     id: 1,
                //     label: 'Category',
                //     children: [{
                //         id: 3,
                //         label: 'Painting',
                //     }, {
                //         id: 2,
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
            // this.artworkFilters
            // trans('category')

            let nodeId = 1;

            let filters = [this.trans('category'), this.trans('direction'), this.trans('medium')];

            console.log(this.trans('category'));

            this.artworkFilters.push({
                id: nodeId++,
                label: 'Category',
                children: Object.entries(this.trans('category')).map(function(category) {
                    console.log(category);
                    return {
                        id: nodeId++,
                        label: category[1]
                    }
                })

            })
        },

        methods: {}
    }
</script>