<template>
    <el-row :gutter="20" class="app-dashboard-users__row">
        <el-col :xs="12" :sm="8" class="app-dashboard-users__col" v-for="user in users" :key="user.id">
            <div class="app-dashboard-users__image">
                <img :src="'/imagecache/fit-75' + user.avatar_url" alt="">
            </div>
            <div class="app-dashboard-users__info">
                <a :href="'/user/' + user.id" target="_blank" class="app-dashboard-users__name">
                    {{ user.name }}
                </a>
                <div class="app-dashboard-users__role">
                    {{ user.role }}
                </div>
                <div class="app-dashboard-users__seller">
                    {{ user.seller_type }}
                </div>
                <a :href="'/dashboard/users/' + user.id + '/edit'"
                   class="el-button el-button--default el-button--mini app-dashboard-users__edit">
                    edit
                </a>
            </div>
        </el-col>
    </el-row>
</template>

<script>
    export default {
        props: {
            users: {}
        },
    }
</script>

<style scoped>

</style>