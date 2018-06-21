<template>
    <div class="app-registration">
        <el-steps :active="active" finish-status="success">
            <el-step title="Step 1"></el-step>
            <el-step title="Step 2">More</el-step>
            <el-step title="Step 3">And more</el-step>
        </el-steps>

        <template v-if="active === 1">
            Tell us Who you are

            <div>
                <el-radio v-model="userType" label="user" border>User</el-radio>
                <el-radio v-model="userType" label="artist" border>Artist</el-radio>
                <el-radio v-model="userType" label="gallery" border>Gallery</el-radio>
            </div>
        </template>

        <el-button style="margin-top: 12px;" @click="next">Next step</el-button>
    </div>


</template>

<script>
    export default {
        data() {
            return {
                active: 1,
                userType: '',
            };
        },

        methods: {
            next() {
                if (this.active++ > 2) this.active = 0;
            }
        }
    }
</script>
