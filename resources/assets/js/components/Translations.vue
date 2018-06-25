<template>


    <el-card v-if="translations">

        <h2>Translations</h2>

        <el-button style="margin-bottom: 20px"
                   size="big"
                   type="success"
                   @click="addTranslationField()">
            Add translation
        </el-button>

        <el-tabs type="card">
            <template v-for="language in languages">
                <el-tab-pane :label="language.name">

                    <template v-for="(translation, idx) in translations">

                        <el-row :gutter="20" style="margin-bottom: 20px" align="middle">
                            <el-col :span="4">
                                <el-input v-model="translation.key" placeholder="Variable"></el-input>
                            </el-col>
                            <el-col :span="18">
                                <el-input v-model="translation.text[language.code]"
                                          placeholder="Translation"></el-input>
                            </el-col>
                            <el-col :span="2">
                                <el-button size="medium" type="danger" icon="el-icon-delete" circle
                                           @click="removeTranslation(idx)"></el-button>
                            </el-col>
                        </el-row>

                    </template>

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
            translations_: {},
            languages_: {}
        },

        data() {
            return {
                languages: [],

                translations: [],
            }
        },

        mounted() {
            if (this.languages_.length) {
                this.languages = this.languages_;
            }
            if (this.translations_.length) {
                this.translations = this.translations_;
            }
        },

        computed: {},

        methods: {

            addTranslationField() {

                let translation = {
                    id: 0,
                    group: 'portal',
                    key: '',
                    text: {},
                };

                Object.entries(this.languages).forEach(
                    ([langCode, language]) => this.$set(translation.text, langCode, "")
                );

                this.translations.push(translation);
            },

            removeTranslation(idx) {
                this.translations.splice(idx, 1);
            },

            save() {

                axios.post('/api/translations/', this.translations)
                    .then((response) => {
                        if (response.data) {
                            window.location.href = '/dashboard';
                        } else {
                            console.log(response.data);
                        }
                    });
            }
        }
    }
</script>
