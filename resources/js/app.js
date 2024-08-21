require('./bootstrap');

window.Vue = require('vue');

Vue.component('task-list', require('./components/TaskList.vue').default);

const app = new Vue({
    el: '#app',
});
