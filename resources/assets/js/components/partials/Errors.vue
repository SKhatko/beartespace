<template>
    <div class="error">

        <el-alert
                style="margin-bottom: 5px;"
                v-for="error in errors" :key="error"
                :title="error"
                type="error"
                show-icon>
        </el-alert>

        <el-alert
                style="margin-bottom: 5px;"
                v-for="error in validationErrors" :key="error[0]"
                :title="error[0]"
                type="error"
                show-icon
                :closable="false">
        </el-alert>
    </div>
</template>

<script>

    export default {

        props: {},

        data() {
            return {
                errors: {},
            }
        },

        mounted() {
            this.errors = window.bus.errors;
        },

        computed: {
            validationErrors() {
                return this.$store.state.errors;
            }
        }
    }
</script>