<template>
    <div>
        <span @click="dialogVisible = true">
            <slot></slot>
        </span>

        <el-dialog
                title="Register"
                :visible.sync="dialogVisible"
                width="300px">
            <register-form></register-form>
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