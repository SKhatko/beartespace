/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// require('./main');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import ElementUI from 'element-ui';
import store from './store.js';
import locale from 'element-ui/lib/locale/lang/en'

Vue.prototype.trans = (key) => {
    return get(window.trans, key, key);
};

Vue.prototype.options = (key) => {
    return Object.entries(get(window.trans, key, key)).map(function (translation) {
        return {value: translation[0], label: translation[1]}
    });
};

Vue.use(Vuex);
Vue.use(ElementUI, {locale});

Vue.component('subscription-form', require('./components/payment/SubscriptionForm.vue'));
Vue.component('partials-artwork', require('./components/partials/Artwork.vue'));
Vue.component('signup-dialog', require('./components/auth/SignupDialog.vue'));

Vue.component('artworks-menu', require('./components/ArtworksMenu.vue'));
Vue.component('artists-menu', require('./components/ArtistsMenu.vue'));

// Auth
Vue.component('password-reset-new-password', require('./components/auth/PasswordResetNewPassword.vue'));
Vue.component('register-form', require('./components/auth/RegisterForm.vue'));
Vue.component('password-reset-form', require('./components/auth/PasswordResetForm.vue'));
Vue.component('login-form', require('./components/auth/LoginForm.vue'));
Vue.component('change-email-form', require('./components/auth/ChangeEmailForm.vue'));

// Admin
Vue.component('settings', require('./components/dashboard/admin/Settings'));
Vue.component('translations', require('./components/dashboard/admin/Translations.vue'));
Vue.component('languages', require('./components/dashboard/admin/Languages.vue'));
Vue.component('pages', require('./components/dashboard/admin/Pages.vue'));
Vue.component('users', require('./components/dashboard/admin/Users.vue'));

// User
Vue.component('profile', require('./components/dashboard/user/Profile.vue'));
Vue.component('artwork-form', require('./components/dashboard/ArtworkForm.vue'));

// Global components
Vue.component('pagination', require('./components/global/Pagination.vue'));
Vue.component('errors', require('./components/partials/Errors.vue'));


const app = new Vue({
    el: '#app',
    store: new Vuex.Store(store),
    components: {},
    data: {
        showRegisterDialog: false
    },
    mounted() {

        if (window.bus.alert) {
            this.$alert(window.bus.alert.message, window.bus.alert.title, {
                confirmButtonText: 'OK',
            });
        } else if(window.bus.notify) {
            this.$notify.info({
                dangerouslyUseHTMLString: true,
                title: window.notify.title,
                message: window.notify.message,
                duration: window.notify.duration ? window.notify.duration : 0,
            });
        }

        if (window.notify) {
            this.$notify.info({
                title: window.notify.title,
                dangerouslyUseHTMLString: true,
                message: window.notify.message,
                duration: 8000
            });
        }

        if (window.status) {
            this.$message({
                showClose: true,
                message: window.status,
                type: 'success',
                duration: 6000
            });
        }

        if (window.error) {
            this.$message({
                showClose: true,
                message: window.error,
                type: 'error',
                duration: 6000
            })
        }

        if (window.cart) {
            this.$store.commit('setInitialCart', window.cart);
        }
        //
        axios.get('/api/profile')
            .then(response => {
                console.log('profile', response.data);
            })
            .catch(error => {
                console.log(error.response);
            })
        //     .catch(error => {
        //         if(error.response.status === 401) {
        //             // window.location.href = '/login';
        //
        //
        //             console.log(error.response);
        //
        //         }
        //     });
    },
    methods: {}
});


