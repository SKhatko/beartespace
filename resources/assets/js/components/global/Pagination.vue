<template>

    <div class="app-pagination" style="text-align: center;margin: 40px 0;">
        <el-pagination
                background
                @current-change="changePage"
                :current-page="paginator.current_page"
                @size-change="changeSize"
                :page-sizes="[3, 15, 30, 50]"
                :page-size="paginator.per_page"
                layout="sizes, prev, pager, next"
                :total="paginator.total">
        </el-pagination>
    </div>

</template>


<script>
    // {{ $paginator->currentPage() }}

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
                console.log(this.paginator);
            }
        },

        methods: {
            changeSize(items) {
                if (items) {
                    this.setQueryVariable('items', items);
                }
            },
            setQueryVariable(variable, value) {
                window.location.search = '?' + variable + '=' + value;


                let oldQuery = window.location.search.substring(1);
                let newQuery = '?';
                let vars = oldQuery.split('&');
                console.log(vars);
                for (let i = 0; i < vars.length; i++) {
                    let pair = vars[i].split('=');
                    if (decodeURIComponent(pair[0]) === variable) {
                        newQuery += pair[0] + '=' + value;
                        continue;
                    }

                    // if(pair[0]) {
                    //     newQuery += pair[0] + '=' + pair[1] + '&';
                    // }
                }

                console.log(newQuery);

                if (newQuery.length > 1) {
                    // window.location.search = newQuery;
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
            },

            changePage(page) {
                console.log(page);
                if (page) {
                    this.setQueryVariable('page', page);
                }
            }

        }
    }
</script>