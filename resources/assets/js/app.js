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
import Croppa from 'vue-croppa';
import VueAwesomeSwiper from 'vue-awesome-swiper'


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
Vue.use(Croppa, {componentName: 'cropper'});
Vue.use(VueAwesomeSwiper, {
    slidesPerView: 'auto',
    spaceBetween: 30
});

Vue.component('partials-artwork', require('./components/partials/Artwork.vue'));

Vue.component('artworks-menu', require('./components/ArtworksMenu.vue'));
Vue.component('artists-menu', require('./components/ArtistsMenu.vue'));

Vue.component('password-reset-new-password', require('./components/auth/PasswordResetNewPassword.vue'));
Vue.component('register-form', require('./components/auth/RegisterForm.vue'));
Vue.component('password-reset-form', require('./components/auth/PasswordResetForm.vue'));
Vue.component('login-form', require('./components/auth/LoginForm.vue'));

Vue.component('translations', require('./components/dashboard/Translations.vue'));
Vue.component('languages', require('./components/dashboard/Languages.vue'));
Vue.component('users', require('./components/dashboard/Users.vue'));
Vue.component('profile', require('./components/dashboard/Profile.vue'));
Vue.component('artwork', require('./components/dashboard/Artwork.vue'));
Vue.component('pages', require('./components/dashboard/Pages.vue'));

const app = new Vue({
    el: '#app',
    store: new Vuex.Store(store),
    components: {},
    data: {},
    mounted() {

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
    }
});


