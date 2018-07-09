
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./main');

window.Vue = require('vue');

require('froala-editor/js/froala_editor.pkgd.min');

// Import and use Vue Froala lib.
import VueFroala from 'vue-froala-wysiwyg';

Vue.use(VueFroala);
//
// var grid = document.querySelector('.grid');
// var msnry = new Masonry( grid, {
//     // options...
//     itemSelector: '.grid-item',
//     columnWidth: 100
// });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'

Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key);
};

Vue.prototype.options = (key) => {
    return Object.entries(_.get(window.trans, key, key)).map(function (translation) {
        return {value: translation[0], label: translation[1]}
    });
};


Vue.use(ElementUI, {locale});


Vue.component('register-form', require('./components/RegisterForm.vue'));
Vue.component('login-form', require('./components/LoginForm.vue'));
Vue.component('translations', require('./components/Translations.vue'));
Vue.component('languages', require('./components/Languages.vue'));
Vue.component('users', require('./components/Users.vue'));
Vue.component('profile', require('./components/Profile.vue'));
Vue.component('artwork', require('./components/Artwork.vue'));
Vue.component('pages', require('./components/Pages.vue'));

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

const app = new Vue({
    el: '#app',
    components: {

    },
    data: {
        artworkFilters: [{
            id: 1,
            label: 'Category',
            children: [{
                id: 3,
                label: 'Painting',
            }, {
                id: 2,
                label: 'Sculpture'
            }]
        }],
        defaultProps: {
            children: 'children',
            label: 'label',
            disabled: 'disabled',
        },
    }
});


