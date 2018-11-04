<template>

    <div class="app-dashboard-users" v-if="loaded">
        <el-card>

            <el-input v-model="filter" placeholder="Filter" @input="filterUsers"
                      style="max-width: 290px; margin-bottom: 20px;"></el-input>

            <el-tabs value="all">
                <el-tab-pane :label="'All users (' + users.length + ')'" name="all">
                    <users-row :users="users"></users-row>
                </el-tab-pane>
                <el-tab-pane :label="'Admins  (' + admins.length + ')'" name="admins">
                    <users-row :users="admins"></users-row>
                </el-tab-pane>
                <el-tab-pane :label="'Artists (' + artists.length + ')'" name="artists">
                    <users-row :users="artists"></users-row>
                </el-tab-pane>
                <el-tab-pane :label="'Galleries (' + galleries.length + ')'" name="galleries">
                    <users-row :users="galleries"></users-row>
                </el-tab-pane>
                <el-tab-pane :label="'New sellers  (' + newSellers.length + ')'" name="new">
                    <users-row :users="newSellers"></users-row>
                </el-tab-pane>
            </el-tabs>

        </el-card>
    </div>

</template>

<script>
    export default {
        props: {
            users_: {},
        },
        data() {
            return {
                loaded: false,
                filter: '',
                users: {},
            }
        },
        mounted() {
            if (this.users_) {
                this.users = JSON.parse(this.users_);
            }
            this.loaded = true;

            console.log(this.users);
        },
        methods: {
            filterUsers() {
                this.users = JSON.parse(this.users_).filter(user => {
                    return user.name.toLowerCase().indexOf(this.filter.toLowerCase()) >= 0;
                })
            }
        },
        computed: {
            artists() {
                return this.users.filter(user => {
                    return user.seller_type === 'artist';
                });
            },
            galleries() {
                return this.users.filter(user => {
                    return user.seller_type === 'gallery';
                });
            },
            admins() {
                return this.users.filter(user => {
                    return user.role === 'admin';
                });
            },
            newSellers() {
                return this.users.filter(user => {
                    return user.seller_status === 'pending';
                });
            }
        }
    }
</script>

<style scoped>

</style>


<!--<template>-->

<!--<el-card>-->
<!--<template v-if="users">-->

<!--&lt;!&ndash;<el-table&ndash;&gt;-->
<!--&lt;!&ndash;v-if="users.length"&ndash;&gt;-->
<!--&lt;!&ndash;:data="users"&ndash;&gt;-->
<!--&lt;!&ndash;style="width: 100%">&ndash;&gt;-->
<!--&lt;!&ndash;<el-table-column type="expand">&ndash;&gt;-->
<!--&lt;!&ndash;<template slot-scope="props">&ndash;&gt;-->
<!--&lt;!&ndash;{{ props.row }}&ndash;&gt;-->
<!--&lt;!&ndash;</template>&ndash;&gt;-->
<!--&lt;!&ndash;</el-table-column>&ndash;&gt;-->
<!--&lt;!&ndash;<el-table-column&ndash;&gt;-->
<!--&lt;!&ndash;sortable&ndash;&gt;-->
<!--&lt;!&ndash;label="id">&ndash;&gt;-->
<!--&lt;!&ndash;<template slot-scope="scope">&ndash;&gt;-->
<!--&lt;!&ndash;{{ scope.row.id }}&ndash;&gt;-->
<!--&lt;!&ndash;</template>&ndash;&gt;-->
<!--&lt;!&ndash;</el-table-column>&ndash;&gt;-->
<!--&lt;!&ndash;<el-table-column&ndash;&gt;-->
<!--&lt;!&ndash;sortable&ndash;&gt;-->
<!--&lt;!&ndash;label="Name"&ndash;&gt;-->
<!--&lt;!&ndash;width="180">&ndash;&gt;-->
<!--&lt;!&ndash;<template slot-scope="scope">&ndash;&gt;-->
<!--&lt;!&ndash;{{ scope.row.name }}&ndash;&gt;-->
<!--&lt;!&ndash;</template>&ndash;&gt;-->
<!--&lt;!&ndash;</el-table-column>&ndash;&gt;-->
<!--&lt;!&ndash;<el-table-column&ndash;&gt;-->
<!--&lt;!&ndash;sortable&ndash;&gt;-->
<!--&lt;!&ndash;label="Email"&ndash;&gt;-->
<!--&lt;!&ndash;width="180">&ndash;&gt;-->
<!--&lt;!&ndash;<template slot-scope="scope">&ndash;&gt;-->
<!--&lt;!&ndash;{{ scope.row.email }}&ndash;&gt;-->
<!--&lt;!&ndash;</template>&ndash;&gt;-->
<!--&lt;!&ndash;</el-table-column>&ndash;&gt;-->
<!--&lt;!&ndash;<el-table-column&ndash;&gt;-->
<!--&lt;!&ndash;:filters="[{text: 'Author', value: 'author'}, {text: 'User', value: 'user'}, {text: 'Gallery', value: 'gallery'}, {text: 'Admin', value: 'admin'}]"&ndash;&gt;-->
<!--&lt;!&ndash;:filter-method="filterTag"&ndash;&gt;-->
<!--&lt;!&ndash;label="Type">&ndash;&gt;-->
<!--&lt;!&ndash;<template slot-scope="scope">&ndash;&gt;-->
<!--&lt;!&ndash;{{ scope.row.roles }}&ndash;&gt;-->
<!--&lt;!&ndash;&lt;!&ndash;<el-checkbox  v-model="languages[scope.$index].is_rtl"></el-checkbox>&ndash;&gt;&ndash;&gt;-->
<!--&lt;!&ndash;</template>&ndash;&gt;-->
<!--&lt;!&ndash;</el-table-column>&ndash;&gt;-->
<!--&lt;!&ndash;<el-table-column&ndash;&gt;-->
<!--&lt;!&ndash;label="Active">&ndash;&gt;-->
<!--&lt;!&ndash;<template slot-scope="scope">&ndash;&gt;-->
<!--&lt;!&ndash;{{ scope.row.active_status }}&ndash;&gt;-->
<!--&lt;!&ndash;&lt;!&ndash;<el-checkbox v-model="languages[scope.$index].active"></el-checkbox>&ndash;&gt;&ndash;&gt;-->
<!--&lt;!&ndash;</template>&ndash;&gt;-->
<!--&lt;!&ndash;</el-table-column>&ndash;&gt;-->
<!--&lt;!&ndash;<el-table-column&ndash;&gt;-->
<!--&lt;!&ndash;label="">&ndash;&gt;-->
<!--&lt;!&ndash;<template slot-scope="scope">&ndash;&gt;-->
<!--&lt;!&ndash;<el-button&ndash;&gt;-->
<!--&lt;!&ndash;v-if="scope.row.role !== 'admin'"&ndash;&gt;-->
<!--&lt;!&ndash;type="danger"&ndash;&gt;-->
<!--&lt;!&ndash;icon="el-icon-delete"&ndash;&gt;-->
<!--&lt;!&ndash;circle&ndash;&gt;-->

<!--&lt;!&ndash;@click.native.prevent="deleteUser(scope.$index, users)"></el-button>&ndash;&gt;-->
<!--&lt;!&ndash;</template>&ndash;&gt;-->
<!--&lt;!&ndash;</el-table-column>&ndash;&gt;-->

<!--&lt;!&ndash;</el-table>&ndash;&gt;-->

<!--</template>-->
<!--</el-card>-->

<!--</template>-->

<!--<script>-->

<!--export default {-->

<!--props: {-->
<!--users_: {},-->
<!--},-->

<!--data() {-->
<!--return {-->
<!--users: {},-->
<!--}-->
<!--},-->


<!--mounted() {-->

<!--if (this.users_) {-->
<!--this.users = JSON.parse(this.users_);-->
<!--}-->

<!--console.log(this.users);-->
<!--},-->

<!--methods: {-->
<!--deleteUser(index, rows) {-->

<!--this.$confirm('This will permanently delete user. Continue?', 'Warning', {-->
<!--confirmButtonText: 'OK',-->
<!--cancelButtonText: 'Cancel',-->
<!--type: 'warning'-->
<!--}).then(() => {-->
<!--let user = rows[index];-->

<!--axios.post('/api/user', user).then(response => {-->
<!--this.$message({-->
<!--type: response.data.type,-->
<!--message: response.data.message-->
<!--});-->
<!--&lt;!&ndash;&ndash;&gt;-->
<!--rows.splice(index, 1);-->
<!--});-->
<!--})-->
<!--},-->

<!--filterTag(value, row, column) {-->
<!--console.log(value);-->
<!--console.log(row);-->
<!--const property = column['property'];-->
<!--return row[property] === value;-->
<!--},-->

<!--save() {-->

<!--axios.post('/api/users/', this.users)-->
<!--.then((response) => {-->
<!--if (response.data) {-->
<!--console.log(response.data);-->
<!--window.location.reload();-->
<!--} else {-->
<!--console.log(response.data);-->
<!--}-->
<!--});-->
<!--}-->
<!--}-->
<!--}-->
<!--</script>-->