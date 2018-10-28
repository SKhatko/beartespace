<template>

    <div class="app-dashboard-articles">
        <el-card>

            <a href="/dashboard/article/create" class="el-button el-button--default">Add new article</a>
            <el-input v-model="filter" placeholder="Filter" @input="filterArticles"
                      style="max-width: 290px"></el-input>

            <el-row :gutter="20" class="app-dashboard-articles__row">
                <el-col :xs="12" :sm="6" class="app-dashboard-articles__col" v-for="article in articles" :key="article.id">
                    <div class="app-dashboard-articles__image">
                        <img :src="'/imagecache/fit-150' + article.image_url" alt="">

                        <a :href="'/dashboard/article/' + article.id + '/edit'"
                           class="el-button el-button--default el-button--mini app-dashboard-articles__edit">
                            edit
                        </a>
                    </div>
                    <a :href="'/article/' + article.id" target="_blank" class="app-dashboard-articles__name">
                        {{ article.name }}
                    </a>
                    <!--<div>Created at: {{ article.created_at }}</div>-->
                </el-col>
            </el-row>
        </el-card>
    </div>

</template>

<script>
    export default {
        props: {
            articles_: {},
        },
        data() {
            return {
                filter: '',
                articles: {},
            }
        },
        mounted() {
            if (this.articles_) {
                this.articles = JSON.parse(this.articles_);
            }
        },
        methods: {
            filterArticles() {
                this.articles = JSON.parse(this.articles_).filter(article => {
                    return article.name.toLowerCase().indexOf(this.filter.toLowerCase()) >= 0;
                })
            }
        }
    }
</script>

<style scoped>

</style>