<template>

    <div>
        <a href="/register" @click.prevent="showSignupDialog = !showSignupDialog">{{ trans('portal')['signup']}}</a>

        <el-dialog
                :visible.sync="showSignupDialog"
                width="30%"
                center>

            <div class="register">
                <el-row :gutter="20" style="margin-bottom: 20px">
                    <el-col>
                        <a href="/invite/customer">

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
                        <a href="/invite/artist">
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
                        <a href="/invite/gallery">
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

    .register {

        .icon {
            display: block;
            font-size: 32px;
            border-right: 2px solid white;
            margin-right: 10px;
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