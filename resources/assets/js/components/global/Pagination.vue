<template>

    <div class="app-pagination" style="text-align: center;margin: 40px 0;">
        <el-pagination
                background
                @current-change="changePage"
                :current-page="paginator.current_page"
                @size-change="changeSize"
                :page-sizes="[5, 10, 20, 30]"
                :page-size="paginator.per_page"
                layout="sizes, prev, pager, next"
                :total="paginator.total">
        </el-pagination>
    </div>

</template>


<script>

    export default {

        props: {
            paginator_: {}
        },

        data() {
            return {
                paginator: {}
            }
        },

        mounted() {

            if (this.paginator_) {
                this.paginator = JSON.parse(this.paginator_);
            }

            // console.log(this.paginator);

        },

        methods: {
            changeSize(items) {
                this.setQueryVariable('items', items);
            },

            changePage(page) {
                this.setQueryVariable('page', page);
            },

            setQueryVariable(variable, value) {

                let oldData = this.getQueryVariable(variable);

                if(oldData) {

                    let oldQuery = window.location.search.substring(1);
                    let newQuery = '?';
                    let vars = oldQuery.split('&');

                    for (let i = 0; i < vars.length; i++) {
                        let pair = vars[i].split('=');
                        if (decodeURIComponent(pair[0]) === variable) {
                            newQuery += pair[0] + '=' + value + '&';
                        } else {
                            newQuery += pair[0] + '=' + pair[1] + '&';
                        }
                    }

                    window.location.search = newQuery;

                } else {
                    let query = window.location.search.substring(1);
                    query += variable + '=' + value + '&';
                    window.location.search = query;
                }
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