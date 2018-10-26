<template>
    <div>
        <span @click="dialogVisible = true">
            <slot></slot>
        </span>

        <el-dialog
                title="Login"
                :visible.sync="dialogVisible"
                width="300px">
            <login-form></login-form>
        </el-dialog>
    </div>


</template>

<script>
    export default {
        data() {
            return {
                dialogVisible: false
            }
        }

    }
</script>

<style scoped>

</style>