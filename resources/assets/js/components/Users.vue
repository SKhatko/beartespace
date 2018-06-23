<template>

    <div v-if="users">

        <h2>Users</h2>
        <!--
                "id": 1,
                "name": "Stanislav Khatko",
                "first_name": null,
                "last_name": null,
                "user_name": null,
                "email": "s.a.hatko@gmail.com",
                "email_token": null,
                "country_id": 228,
                "mobile": "+380994707479",
                "gender": "male",
                "address": "Schvedska Mogyla 25",
                "website": "funsite.club",
                "phone": "994707479",
                "photo": "15295139454znzq-img-4994-copy.jpg",
                "photo_storage": "public",
                "user_type": "admin",
                "active_status": "1",
                "email_verified": null,
                "activation_code": null,
                "is_online": null,
                "last_login": null,
                "created_at": "2018-01-06 12:36:58",
                "updated_at": "2018-06-20 16:59:05"-->


        <template>
            <el-table
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
                <!--<el-table-column-->
                <!--label="">-->
                <!--<template slot-scope="scope">-->
                <!--<el-button size="mini" type="danger" icon="el-icon-delete" circle>-->
                <!--</el-button>-->
                <!--</template>-->
                <!--</el-table-column>-->
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
                users: [],
            }
        },


        mounted() {
            if (this.users_) {
                this.users = this.users_;

            }

            console.log(this.users_);
        },

        methods: {

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