<template>

    <div style="margin-top: 10px;">
        <el-button v-if="follow" size="mini" plain @click="unfollowUser"><i class="el-icon-star-on"></i> Unfollow
            <slot></slot>
        </el-button>
        <el-button v-else plain size="mini" @click="followUser"><i class="el-icon-star-off"></i> Follow
            <slot></slot>
        </el-button>
    </div>
</template>

<script>
    export default {
        props: {
            userId_: '',
            follow_: '',
        },
        data() {
            return {
                follow: '',
                userId: '',
            }
        },
        methods: {
            followUser() {
                this.toggleFollowUser();
            },
            unfollowUser() {
                this.$confirm('Are you going to unfollow this artist. Continue?', 'Warning', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                }).then(() => {
                    this.toggleFollowUser();
                }).catch(() => {
                });
            },
            toggleFollowUser() {
                axios.put('/api/user/followed/' + this.userId + '/toggle',).then(response => {
                    console.log(response.data.data);

                    this.follow = !this.follow;

                    this.$message({
                        showClose: true,
                        message: response.data.message,
                        type: response.data.status
                    });

                }).catch(error => {
                    if (error.response.status === 401) {
                        window.location.href = '/login';
                        console.log(error.response);
                    }
                });
            }
        },
        mounted() {

            if (this.userId_) {
                this.userId = this.userId_;
            }

            this.follow = this.follow_ === '1';

        }
    }
</script>

<style scoped>

</style>