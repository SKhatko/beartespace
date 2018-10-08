<template>


    <el-card v-if="translations">

        <h2>Translations</h2>

        <el-collapse v-for="(group, groupName) in translations" :key="groupName" accordion v-model="activeGroup">

            <el-collapse-item :title="groupName" :name="groupName">

                <el-tabs type="card">

                    <template v-for="language in languages">

                        <el-tab-pane :label="language.name">

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

                            <el-button type="primary" style="margin-top: 20px"
                                       size="big"
                                       @click="save()">
                                Save
                            </el-button>

                        </el-tab-pane>
                    </template>

                </el-tabs>

            </el-collapse-item>

        </el-collapse>

        <el-form inline style="margin-top: 20px">
            <el-form-item label="Add new group">
                <el-input v-model="newGroup"></el-input>
            </el-form-item>
            <el-button type="success" @click="addTranslationField(newGroup)">Add</el-button>

        </el-form>

    </el-card>

</template>

<script>

    export default {

        props: {
            translations_: {},
            languages_: {}
        },

        data() {
            return {
                languages: [],
                translations: [],
                activeGroup: '',
                newGroup: '',
            }
        },

        mounted() {

            if (this.languages_) {
                this.languages = this.languages_;
            }

            if (this.translations_) {
                this.translations = JSON.parse(this.translations_);
            }

        },

        methods: {

            addTranslationField(groupName) {

                let translation = {
                    id: 0,
                    group: groupName,
                    key: 'variable',
                    text: {},
                };

                Object.entries(this.languages).forEach(
                    ([langCode, language]) => this.$set(translation.text, langCode, "")
                );

                console.log(this.translations);

                if (!this.translations[groupName]) {
                    this.translations[groupName] = [];
                }

                console.log(this.translations[groupName]);

                this.activeGroup = groupName;

                this.translations[groupName].push(translation);
            },

            removeTranslation(groupName, translationIndex) {
                this.translations[groupName].splice(translationIndex, 1);
            },

            save() {
                axios.post('/api/translations/', this.translations)
                    .then((response) => {
                        if (response.data) {
                            console.log(response.data);

                            this.translations = response.data.data;

                            this.$message({
                                showClose: true,
                                message: response.data.message,
                                type: response.data.status
                            });
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
