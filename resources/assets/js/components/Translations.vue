<template>


    <div class="col-xs-12 app-content portal_form" v-if="translations">

        <h2>Translations</h2>

        <el-button style="margin-bottom: 20px"
                   size="big"
                   @click="addTranslationField()">
            Add translation
        </el-button>

        <el-tabs type="card">
            <template v-for="(language, langCode) in languages">
                <el-tab-pane :label="language">


                    <template v-for="(translation, idx) in translations">

                        <el-form :inline="true">
                            <el-form-item>
                                <el-input v-model="translation.key" placeholder="key"></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-input v-model="translation.text[langCode]" placeholder="value"></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="danger" icon="el-icon-delete" circle @click="removeTranslation(idx)"></el-button>
                            </el-form-item>
                        </el-form>

                        <!--<el-input placeholder="Please input" v-model="translation.text[langCode]">-->
                        <!--<template slot="prepend">{{ translation.key }}</template>-->
                        <!--</el-input>-->

                        <!--<el-input :placeholder="translation.key[key]" v-model="translation.key[key]"></el-input>-->


                        <!--{{ translation.key }} - {{ translation.text }}-->
                    </template>


                </el-tab-pane>
            </template>

        </el-tabs>

        <el-button style="margin-top: 20px"
                   size="big"
                   @click="save()">
            Save
        </el-button>

    </div>

</template>

<script>

    export default {

        props: {
            translations_: {}
        },

        data() {
            return {
                languages: {
                    en: 'English',
                    da: 'Danish',
                    ru: 'Russian'
                },

                translations: [],
            }
        },

        mounted() {
            console.log(this.languages);
            console.log(this.translations_);
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

                axios.post('/api/translations/', {translations: this.translations})
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
