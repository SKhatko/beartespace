<template>

    <div class="app-dashboard-articles">
        <el-card>
            <a href="/dashboard/article/create" class="el-button el-button--default">Add new article</a>

            <div class="articles">
                <div class="article" v-for="article in articles">
                    <div class="article-image">
                        <img :src="'/imagecache/fit-75' + article.image_url" alt="">
                    </div>
                    <a :href="'/article/' + article.id" target="_blank" class="article-name">
                        {{ article.name }}
                    </a>
                    <a :href="'/dashboard/article/' + article.id + '/edit'"
                       class="el-button el-button--default el-button--mini">
                        edit
                    </a>
                </div>
            </div>
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
                articles: {},
            }
        },
        mounted() {
            if (this.articles_) {
                this.articles = JSON.parse(this.articles_);
            }
        }
    }
</script>

<style scoped>

</style>