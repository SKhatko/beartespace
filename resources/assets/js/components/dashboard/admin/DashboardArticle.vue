<template>
    <div class="app-dashboard-article">
        <el-card>
            <el-form>
                <el-form-item label="Title">
                    <el-input v-model="article.name"></el-input>
                </el-form-item>
                <el-form-item label="content">
                    <el-input v-model="article.content"></el-input>
                </el-form-item>
            </el-form>
        </el-card>
    </div>
</template>

<script>
    export default {
        props: {
            article_: {},
        },
        data() {
            return {
                article: {},
            }
        },
        mounted() {
            if (this.article_) {
                this.article = JSON.parse(this.article_);
            }
        },
        methods: {

            save() {
                this.$refs['article'].validate((valid) => {
                    if (valid) {
                        this.loading = true;
                        console.log(this.article);
                        axios.post('/api/article/', this.user)
                            .then((response) => {
                                console.log(response.data);
                                // window.location = '/dashboard';
                            }).catch(error => {
                            console.log(error.response);
                        });
                    }
                });
            },
        }
    }
</script>

<style scoped>

</style>