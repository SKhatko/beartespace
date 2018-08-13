<template>
    <el-card class="box-card app-auth-login">
        <div slot="header" class="clearfix">
            <i class="el-icon-success"></i> &nbsp;
            Update your subscription for using our service
        </div>

        <el-form action="/subscription/stripe" method="POST">
            <input type="hidden" name="stripeToken" v-model="stripeFormData.stripeToken">
            <input type="hidden" name="stripeEmail" v-model="stripeFormData.stripeEmail">

            <el-form-item label="Subscription plan">
                <el-select value="" placeholder="Subscription plan" v-model="selectedPlan">
                    <el-option v-for="plan in plans" :label="trans('portal')[plan.name]" :value="plan.name"
                               :key="plan.id"></el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="">
                <el-switch
                        style="display: block;margin-top: 10px;"
                        v-model="selectedPeriod"
                        active-value="month"
                        inactive-value="year"
                        inactive-color="#409EFF"
                        active-text="Pay by month"
                        inactive-text="Pay by year ( save 10%)">
                </el-switch>
            </el-form-item>

            <el-form-item label="Coupon code">
                <el-input name="coupon" placeholder="Have a coupon code?" v-model="coupon"
                          @input="setCouponDiscount"></el-input>
            </el-form-item>

            <el-form-item v-if="activePlan">
                <div class="h1" style="text-align:center">
                    {{ activePlan[selectedPeriod] }}
                </div>
            </el-form-item>

            <el-button native-type="submit" @click.prevent="payWithStripe" :loading="stripeLoading">Pay with bank cart</el-button>
            <el-button :loading="paypalLoading">Pay with PayPal</el-button>

            <p class="help is-danger" v-show="status" v-text="status"></p>
        </el-form>

    </el-card>
</template>

<script>
    export default {
        props: {
            stripeKey: '',
            plans_: {},
            user_: {},
        },
        data() {
            return {
                user: [],
                stripeFormData: {
                    stripeEmail: '',
                    stripeToken: '',
                    plan: {},
                },

                plan: 1,
                status: false,
                coupon: '',

                selectedPeriod: 'month',
                selectedPlan: 'basic',
                plans: [],
                stripeLoading: false,
                paypalLoading: false
            };
        },
        mounted() {

            console.log(window.cfg);
            if(this.user_) {
                this.user = JSON.parse(this.user_);
            }

            if (this.plans_) {
                this.plans = JSON.parse(this.plans_);
                console.log(this.plans);
            }

            console.log(this.activePlan[this.selectedPeriod + '_price'] * 100);

            this.stripe = StripeCheckout.configure({
                key: this.stripeKey,
                image: "/images/b-favicon-64.png",
                locale: "auto",
                currency: window.cfg.currency,
                email: this.user.email,
                panelLabel: "Subscribe For",
                token: (token) => {
                    this.stripeFormData.stripeToken = token.id;
                    this.stripeFormData.stripeEmail = token.email;
                    this.stripeFormData.plan = this.activePlan;
                    this.stripeFormData.period = this.selectedPeriod;
                    this.stripeFormData.coupon = this.coupon;

                    axios.post('/subscription/stripe', this.stripeFormData)
                        .then(response => {
                            console.log(response.data);
                            response => alert('Complete! Thanks for your payment!'),
                                response => this.status = response.body.status
                        })
                }
            });
        },
        methods: {
            setCouponDiscount() {
                console.log(this.coupon);
            },
            payWithStripe() {
                this.stripeLoading = true;
                this.stripe.open({
                    name: this.activePlan.name,
                    description: 'Subscription plan on BeArteBid',
                    zipCode: false,
                    amount: this.activePlan[this.selectedPeriod + '_price'] * 100,
                });
                this.stripeLoading = false;
            },
        },
        computed: {
            activePlan() {
                return this.plans.filter(plan => {
                    if (plan.name === this.selectedPlan) return plan;
                })[0];
            }
        }
    }
</script>