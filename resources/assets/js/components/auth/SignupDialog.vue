<template>

    <div style="display: inline-block;">
        <a href="/register" v-if="type_ === 'link'" @click.prevent="showSignupDialog = !showSignupDialog" class="el-button el-button--text register-link">{{ trans('portal')['register']}}</a>
        <el-button type="text" v-if="type_ === 'button'" @click.prevent="showSignupDialog = !showSignupDialog">&nbsp; Create New Account</el-button>

        <el-dialog
                :visible.sync="showSignupDialog"
                width="400px"
                center>

            <div class="register">
                <el-row :gutter="20" style="margin-bottom: 20px">
                    <el-col>
                        <a href="/register">

                            <el-card shadow="hover">
                                <i class="icon icon-user-outline"></i>
                                <p> I'm a customer. I want to buy Art</p>
                            </el-card>
                        </a>

                    </el-col>
                </el-row>

                <hr style="margin-bottom: 20px;">

                <el-row :gutter="20" style="margin-bottom: 20px">

                    <el-col>
                        <a href="/register?u=artist">
                            <el-card shadow="hover">
                                <i class="icon icon-art-gallery"></i>
                                <p> I am an artist. I want to sell my artworks</p>
                            </el-card>
                        </a>

                    </el-col>
                </el-row>

                <hr style="margin-bottom: 20px;">

                <el-row :gutter="20">

                    <el-col>
                        <a href="/register?u=gallery">
                            <el-card shadow="hover">
                                <i class="icon icon-picture"></i>
                                <p> I am a Gallery. I want to buy and sell art</p>
                            </el-card>
                        </a>
                    </el-col>
                </el-row>

            </div>

        </el-dialog>

    </div>


</template>

<script>
    export default {
        props: {
            type_: ''
        },
        data() {
            return {
                showSignupDialog: false
            }
        },
        mounted() {

        }

    }
</script>

<style lang="scss">

    .register-link {
        color: #606266;
    }

    .register {

        .icon {
            display: block;
            font-size: 32px;
            border-right: 2px solid white;
            margin-right: 10px;
        }

        p {
            line-height: 20px;
        }

        .el-card__body {
            background-color: #3babab;
            color: #ffffff;
            display: flex;
            align-items: center;
            font-size: 16px;
            cursor: pointer;

            &:hover {
                background-color: #379797;
            }
        }
    }


</style>