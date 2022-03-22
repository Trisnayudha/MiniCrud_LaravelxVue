import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//path
const Home = require('../pages/Home').default
const About = require('../pages/About').default
const NotFound = require('../pages/NotFound').default
const User = require('../pages/User').default


const routes = [
    //Route page
    {
        name: 'Home',
        path: '/home',
        component: Home
    },
    {
        name: 'About',
        path: '/about',
        component: About
    },
    {
        name: 'User',
        path: '/user/:name?',
        component: User,
        props: true
    },

    //Not Found page
    {
        path: '*',
        component: NotFound
    },
];

const router = new VueRouter({
    linkActiveClass: 'active',
    mode: 'history',
    routes
})

export default router
