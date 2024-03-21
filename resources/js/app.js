console.log(21212);

// import './bootstrap';
//
// import Alpine from 'alpinejs';
//
// window.Alpine = Alpine;
//
// Alpine.start();
// // Это главный управляющий vue файлик
// import Vue from 'vue'
// Vue.component('TestingHome', require('./Components/TestingHome'));  // Подключаем компоненту из папки resources/js/Components/TestingHome.vue
//
// const app = new Vue({  // Создаем скрипт js
//     el: "#app"
// });


require('./bootstrap');

import { createApp } from 'vue'
import TestingHome from './Components/TestingHome'

// console.log('is running')

const myApp = createApp(TestingHome)
myApp
    .mount('#app')
