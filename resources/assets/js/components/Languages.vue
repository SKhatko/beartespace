<template>


    <div v-if="languages">

        <h2>Languages ( Test all functionality )</h2>

        <!-- TODO test -->

        <el-select style="margin-right: 10px"
                value=""
                v-model="newLanguage"
                filterable
                placeholder="Select new language">
            <el-option
                    v-for="(name, code) in translatedLanguages"
                    :key="code"
                    :label="name"
                    :value="code">
                {{ name }}
            </el-option>
        </el-select>

        <el-button style="margin-bottom: 20px"
                   size="big"
                   type="success"
                   @click="addLanguageField()">
            Add language
        </el-button>

        <template>
            <el-table
                    :data="languages"
                    style="width: 100%">
                <el-table-column
                        label="id">
                    <template slot-scope="scope">
                        {{ scope.row.id }}
                    </template>
                </el-table-column>
                <el-table-column
                        label="Name"
                        width="180">
                    <template slot-scope="scope">
                        {{ scope.row.name }}
                    </template>
                </el-table-column>
                <el-table-column
                        label="Code"
                        width="180">
                    <template slot-scope="scope">
                        {{ scope.row.code }}
                    </template>
                </el-table-column>
                <el-table-column
                        label="rtl">
                    <template slot-scope="scope">
                        <el-checkbox  v-model="languages[scope.$index].is_rtl"></el-checkbox>
                    </template>
                </el-table-column>
                <el-table-column
                        label="Active">
                    <template slot-scope="scope">
                        <el-checkbox v-model="languages[scope.$index].active"></el-checkbox>
                    </template>
                </el-table-column>
                <el-table-column
                        label="">
                    <template slot-scope="scope">
                        <el-button size="mini" type="danger" icon="el-icon-delete" circle
                                   @click="removeLanguage(scope.$index)">
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
        </template>


        <el-button type="primary" style="margin-top: 20px"
                   size="big"
                   @click="save()">
            Save
        </el-button>

    </div>

</template>

<script>

    export default {

        props: {
            translatedLanguages_: {},
            languages_: {},
        },

        data() {
            return {
                languages: [],
                translatedLanguages: [],
                newLanguage: {},
            }
        },


        mounted() {
            if (this.languages_.length) {
                this.languages = this.languages_;
            }


            if (Object.keys(this.translatedLanguages_).length) {
                this.translatedLanguages = this.translatedLanguages_;

            }
        },

        methods: {

            addLanguageField() {

                let language = {
                    id: 0,
                    name: this.translatedLanguages[this.newLanguage],
                    code: this.newLanguage,
                    active: false,
                    is_rtl: false
                };

                // Object.entries(this.languages).forEach(
                //     ([langCode, language]) => this.$set(language.name, language.code, "")
                // );


                this.languages.push(language);
            },

            removeLanguage(index) {
                this.languages.splice(index, 1);
            },

            save() {

                axios.post('/api/languages/', this.languages)
                    .then((response) => {
                        if (response.data) {
                            console.log(response.data);
                            window.location.reload();
                        } else {
                            console.log(response.data);
                        }
                    });
            }
        }
    }
</script>
