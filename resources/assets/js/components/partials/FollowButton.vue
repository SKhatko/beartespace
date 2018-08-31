<template>

    <span>
        <el-button v-if="follow" plain icon="el-icon-close" @click="unfollowUser">Unfollow</el-button>
        <el-button v-else plain icon="el-icon-plus" @click="followUser">Follow</el-button>
    </span>
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

            if (this.follow_ === '1') {
                this.follow = true;
            } else {
                this.follow = false;
            }
        }
    }
</script>

<style scoped>

</style>