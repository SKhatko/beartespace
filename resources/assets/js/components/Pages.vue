<template>


    <el-card v-if="pages">

        <h2>Pages</h2>

        <el-tabs type="card">

            <template v-for="language in languages">

                <el-tab-pane :label="language.name">

                    <el-collapse v-for="(group, groupName) in pages" :key="groupName" accordion>

                        <el-collapse-item :title="groupName" :name="groupName">

                            <el-row :gutter="20" style="margin-bottom: 20px" align="middle"
                                    v-for="(translation, translationIndex) in group" :key="translation.id">
                                <el-col :span="4">
                                    <el-input v-model="translation.key" placeholder="Variable"></el-input>
                                </el-col>
                                <el-col :span="18">
                                    <el-input v-model="translation.text[language.code]"
                                              placeholder="Translation"></el-input>
                                </el-col>
                                <el-col :span="2">
                                    <el-button size="mini" type="danger" icon="el-icon-delete" circle
                                               @click="removeTranslation(groupName, translationIndex)"></el-button>
                                </el-col>
                            </el-row>

                            <el-button style="margin-bottom: 20px"
                                       size="big"
                                       type="success"
                                       @click="addTranslationField(groupName)">
                                Add translation to {{ groupName }}
                            </el-button>

                        </el-collapse-item>

                    </el-collapse>


                </el-tab-pane>
            </template>

        </el-tabs>

        <el-button type="primary" style="margin-top: 20px"
                   size="big"
                   @click="save()">
            Save
        </el-button>

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
            }
        },

        mounted() {

            if (this.languages_.length) {
                this.languages = this.languages_;
            }
            if (Object.keys(this.pages_).length) {
                this.pages = this.pages_;
            }
        },

        computed: {},

        methods: {

            addTranslationField(groupName) {

                let translation = {
                    id: 0,
                    group: groupName,
                    key: 'Variable',
                    text: {},
                };

                Object.entries(this.languages).forEach(
                    ([langCode, language]) => this.$set(translation.text, langCode, "")
                );

                console.log(this.pages[groupName]);

                this.pages[groupName].push(translation);
            },

            removeTranslation(groupName, translationIndex) {
                this.pages[groupName].splice(translationIndex, 1);
            },

            save() {
                axios.post('/api/pages/', this.pages)
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
            },
        }
    }
</script>
