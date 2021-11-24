require('./bootstrap');


window.Vue = require('vue').default;

Vue.component('base-nav', require('./components/UI/BaseNav').default);
Vue.component('base-header', require('./components/UI/BaseHeader').default);
Vue.component('base-panel', require('./components/UI/BasePanel').default);
Vue.component('base-input', require('./components/UI/BaseInput').default);
Vue.component('base-sidebar', require('./components/UI/BaseSidebar').default);

/*
import route from '../../vendor/tightenco/ziggy/src/js/route';
import { Ziggy } from './ziggy';
Vue.mixin({
    methods: {
        route: (name, params, absolute) => route(name, params, absolute, Ziggy),
    },
});
*/
const app = new Vue({
    el: '#app',
});
