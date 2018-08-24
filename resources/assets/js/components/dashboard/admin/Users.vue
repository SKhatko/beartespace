<template>

    <div v-if="users">

        <h2>Users</h2>

        <template>

            <el-table
                    v-if="users.length"
                    :data="users"
                    style="width: 100%">
                <el-table-column type="expand">
                    <template slot-scope="props">
                        {{ props.row }}
                    </template>
                </el-table-column>
                <el-table-column
                        sortable
                        label="id">
                    <template slot-scope="scope">
                        {{ scope.row.id }}
                    </template>
                </el-table-column>
                <el-table-column
                        sortable
                        label="Name"
                        width="180">
                    <template slot-scope="scope">
                        {{ scope.row.name }}
                    </template>
                </el-table-column>
                <el-table-column
                        sortable
                        label="Email"
                        width="180">
                    <template slot-scope="scope">
                        {{ scope.row.email }}
                    </template>
                </el-table-column>
                <el-table-column
                        :filters="[{text: 'Author', value: 'author'}, {text: 'User', value: 'user'}, {text: 'Gallery', value: 'gallery'}, {text: 'Admin', value: 'admin'}]"
                        :filter-method="filterTag"
                        label="Type">
                    <template slot-scope="scope">
                        {{ scope.row.user_type }}
                        <!--<el-checkbox  v-model="languages[scope.$index].is_rtl"></el-checkbox>-->
                    </template>
                </el-table-column>
                <el-table-column
                        label="Active">
                    <template slot-scope="scope">
                        {{ scope.row.active_status }}
                        <!--<el-checkbox v-model="languages[scope.$index].active"></el-checkbox>-->
                    </template>
                </el-table-column>
                <el-table-column
                        label="">
                    <template slot-scope="scope">
                        <el-button
                                v-if="scope.row.user_type !== 'admin'"
                                type="danger"
                                icon="el-icon-delete"
                                circle

                                   @click.native.prevent="deleteUser(scope.$index, users)"></el-button>
                    </template>
                </el-table-column>

            </el-table>

        </template>

    </div>

</template>

<script>

    export default {

        props: {
            users_: {},
        },

        data() {
            return {
                users: {},
            }
        },


        mounted() {

            if (this.users_) {
                this.users = JSON.parse(this.users_);
            }

            console.log(this.users);
        },

        methods: {
            deleteUser(index, rows) {

                this.$confirm('This will permanently delete user. Continue?', 'Warning', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                }).then(() => {
                    let user = rows[index];

                    axios.post('/api/user', user).then(response => {
                        this.$message({
                            type: response.data.type,
                            message: response.data.message
                        });

                        rows.splice(index, 1);
                    });
                })
            },

            filterTag(value, row, column) {
                console.log(value);
                console.log(row);
                const property = column['property'];
                return row[property] === value;
            },

            save() {

                axios.post('/api/users/', this.users)
                    .then((response) => {
                        if (response.data) {
                            console.log(response.data);
                            window.location.reload();
                        } else {
                            console.log(response.data);
                        }
                    });
            }
        }
    }
</script>