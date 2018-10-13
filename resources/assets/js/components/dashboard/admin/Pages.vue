<template>


    <el-card>

        <h2>Pages</h2>

        <el-button style="margin-bottom: 20px"
                   size="big"
                   type="success"
                   @click="addNewPage">
            Add new page
        </el-button>

        <el-collapse v-for="page in pages" :key="page.id" accordion v-model="activePage">

            <el-collapse-item :title="page.title" :name="page.id">

                <el-form>
                    <el-row :gutter="20" style="margin-bottom: 20px" align="middle">

                        <el-col :span="12">
                            <el-form-item label="Title">
                                <el-input v-model="page.title" placeholder="Title"></el-input>
                            </el-form-item>
                        </el-col>

                        <el-col :span="12">
                            <el-form-item label="Slug">
                                <el-input v-model="page.slug"
                                          placeholder="Slug"></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>

                    <el-tabs type="card">

                        <!-- TODO fix pages -->

                        <template v-for="language in languages">

                            <el-tab-pane :label="language.name">

                                <quill-editor v-model="page.content[language.code]"></quill-editor>

                            </el-tab-pane>

                        </template>

                    </el-tabs>

                    <el-button type="primary" style="margin-top: 20px"
                               size="big"
                               @click="save(page)">
                        Save
                    </el-button>
                </el-form>

            </el-collapse-item>

        </el-collapse>

    </el-card>

</template>

<script>

    export default {

        props: {
            pages_: {},
            languages_: {}
        },

        data() {
            return {
                languages: [],
                pages: [],
                activePage: ''
            }
        },

        mounted() {

            if (this.languages_) {
                this.languages = JSON.parse(this.languages_);
            }
            if (this.pages_) {
                this.pages = JSON.parse(this.pages_);
            }

        },

        methods: {

            addNewPage() {

                let page = {
                    id: 0,
                    title: 'New Title',
                    slug: 'New slug',
                    content: {},
                    active: true,
                };

                Object.entries(this.languages).forEach(
                    ([langIndex, language]) => this.$set(page.content, language.code, "")
                );

                this.pages.unshift(page);
                this.activePage = 0;
            },

            removeTranslation(pageIndex) {
                this.pages.splice(pageIndex, 1);
            },

            save(page) {
                axios.post('/api/pages/', page)
                    .then((response) => {
                        if (response.data) {
                            console.log(response.data);
                            this.$message({
                                showClose: true,
                                message: response.data.message,
                                type: response.data.status
                            });

                            this.pages = response.data.data;
                            // window.location.reload();
                            // window.location.href = '/dashboard';
                        } else {
                            console.log(response.data);
                        }
                    });
            }
        }
    }
</script>
