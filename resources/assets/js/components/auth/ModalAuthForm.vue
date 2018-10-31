<template>
    <el-dialog :visible.sync="dialogVisible">

        Signin and Signup
    </el-dialog>
</template>

<script>
    export default {
        data() {
            return {
                // dialogVisible: false
            }
        },
        computed: {
            dialogVisible() {
                return this.$store.state.showAuthForm;
            }
        }

    }
</script>

<style scoped>

</style>