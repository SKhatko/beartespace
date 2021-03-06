/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import ElementUI from 'element-ui';
import store from './store.js';
import CollapseTransition from 'element-ui/lib/transitions/collapse-transition';
import locale from 'element-ui/lib/locale/lang/en';
import VueTelInput from 'vue-tel-input';


// Trans function takes translation from db return it on frontend
Vue.prototype.trans = (key) => {
    let defaultValue = key.split('.');
    return get(window.cfg.trans, key, defaultValue[defaultValue.length - 1]);
};

// Options is array of [key => translation] grouped by group of language line
Vue.prototype.options = (key) => {
    let defaultValue = key.split('.');

    return Object.entries(get(window.cfg.trans, key, defaultValue[defaultValue.length - 1])).map(function (translation) {
        return {value: translation[0], label: translation[1]}
    });

    // return Object.entries(get(window.cfg.trans, key, key)).map(function (translation) {
    //     return {value: translation[0], label: translation[1]}
    // });
};


Vue.use(Vuex);
Vue.use(ElementUI, {locale});
Vue.use(VueTelInput);
Vue.use(SocialSharing);
// Vue.use(VueQuillEditor, /* { default global options } */)
Vue.component(CollapseTransition.name, CollapseTransition)




Vue.component('subscription-form', require('./components/payment/SubscriptionForm.vue'));
Vue.component('artwork-index', require('./components/partials/ArtworkIndex.vue'));
Vue.component('artworks-block', require('./components/partials/ArtworksBlock.vue'));
Vue.component('artwork-show-carousel', require('./components/partials/ArtworkShowCarousel.vue'));

Vue.component('artworks-menu', require('./components/ArtworksMenu.vue'));
Vue.component('artists-menu', require('./components/ArtistsMenu.vue'));

// Auth
Vue.component('password-reset-new-password', require('./components/auth/PasswordResetNewPassword.vue'));
Vue.component('register-form', require('./components/auth/RegisterForm.vue'));
Vue.component('password-reset-form', require('./components/auth/PasswordResetForm.vue'));
Vue.component('login-form', require('./components/auth/LoginForm.vue'));
Vue.component('change-email-form', require('./components/auth/ChangeEmailForm.vue'));
Vue.component('modal-auth-form', require('./components/auth/ModalAuthForm.vue'));

// Seller (Sell)
Vue.component('profile-name-form', require('./components/sell/ProfileNameForm.vue'));
Vue.component('sell-profile-form', require('./components/sell/SellProfileForm.vue'));

// Admin
Vue.component('settings-form', require('./components/dashboard/admin/SettingsForm.vue'));
Vue.component('translations-form', require('./components/dashboard/admin/TranslationsForm.vue'));
Vue.component('languages-form', require('./components/dashboard/admin/LanguagesForm.vue'));
Vue.component('pages', require('./components/dashboard/admin/Pages.vue'));
Vue.component('page-form', require('./components/dashboard/admin/PageForm.vue'));
Vue.component('users-form', require('./components/dashboard/admin/UsersForm.vue'));
Vue.component('users-row', require('./components/dashboard/admin/UsersRow.vue'));
Vue.component('user-form', require('./components/dashboard/admin/UserForm.vue'));
Vue.component('dashboard-articles', require('./components/dashboard/admin/DashboardArticles.vue'));
Vue.component('article-form', require('./components/dashboard/admin/ArticleForm.vue'));

// User
Vue.component('profile-form', require('./components/dashboard/user/ProfileForm.vue'));
Vue.component('artwork-form', require('./components/dashboard/user/ArtworkForm.vue'));
Vue.component('dashboard-artworks-block', require('./components/dashboard/user/DashboardArtworksBlock.vue'));

// Global components
Vue.component('pagination', require('./components/global/Pagination.vue'));
Vue.component('errors', require('./components/partials/Errors.vue'));
Vue.component('follow-button', require('./components/partials/FollowButton.vue'));
Vue.component('artwork-quantity-input', require('./components/partials/ArtworkQuantityInput.vue'));
Vue.component('buy-now-form', require('./components/partials/BuyNowForm.vue'));

// Checkout
Vue.component('cart-shipping-form', require('./components/cart/ShippingForm.vue'));
Vue.component('cart-payment-form', require('./components/cart/PaymentForm.vue'));

const app = new Vue({
    el: '#app',
    store: new Vuex.Store(store),
    components: {},
    data: {
        showMainMenu: false,
        activeCollapseArtworkShow: ['description', 'inspiration'],
        fullScreenLoading: false,
    },
    mounted() {

        // Modal alert window
        if (window.bus.alert) {
            this.$alert(
                window.bus.alert.message,
                window.bus.alert.title, {
                    confirmButtonText: 'OK',
                });
        }

        if (window.bus.notify) {
            this.$notify({
                dangerouslyUseHTMLString: true,
                title: window.bus.notify.title,
                message: window.bus.notify.message,
                duration: window.bus.notify.duration ? window.bus.notify.duration : 0,
            });
        }

        if (window.bus.message) {
            console.log(window.bus.message);
            this.$message({
                dangerouslyUseHTMLString: true,
                showClose: true,
                message: window.bus.message.message,
                type: window.bus.message.status,
                duration: 6000
            });
        }

        if (window.bus.error) {
            this.$message({
                showClose: true,
                message: window.bus.error,
                type: 'error',
                duration: 6000
            })
        }

        // Passing initial favorite Artworks
        if (window.bus.favoriteArtworks) {
            this.$store.commit('setInitialFavoriteArtworks', window.bus.favoriteArtworks);
        }

        // Shopping cart initial
        if (window.bus.shoppingCart) {
            this.$store.commit('setInitialShoppingCart', window.bus.shoppingCart);
        }

        axios.get('/api/profile')
            .then(response => {
                console.log('auth');
                // console.log('profile', response.data);
            })
            .catch(error => {
                console.log('not auth');
                console.log(error.response);
            })
    },
    methods: {}
});


