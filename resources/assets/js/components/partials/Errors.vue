<template>
    <div class="error">
        <el-alert
                style="margin-bottom: 5px;"
                v-for="error in errors" :key="error"
                :title="error"
                type="error"
                show-icon>
        </el-alert>
    </div>
</template>

<script>

    export default {

        props: {

        },

        data() {
            return {
                errors: {}
            }
        },

        mounted() {
           this.errors = window.errors;
        },

        methods: {


        }
    }
</script>