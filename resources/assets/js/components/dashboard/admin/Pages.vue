<template>


    <el-card>

        <h2>Pages</h2>

        <el-button style="margin-bottom: 20px"
                   size="big"
                   type="success"
                   @click="addNewPage">
            Add new page
        </el-button>



    </el-card>

</template>

<script>
    import quillEditor from 'vue-quill-editor'

    export default {
        components: quillEditor,

        props: {
            pages_: {},
            languages_: {}
        },

        data() {
            return {
                languages: [],
                pages: [],
                activePage: '',
                editorOption: {

                }

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
