import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import About from '../views/About.vue'
import Contact from '../views/Contact.vue'
import Post from '../views/Post/Post.vue'
import Show from '../views/Post/Show.vue'
import Create from '../views/Post/Create.vue'
import Edit from '../views/Post/Edit.vue'
import Delete from '../views/Post/Delete.vue'
import Login from '../views/Auth/Login.vue'
import Register from '../views/Auth/Register.vue'
import Dashboard from '../views/Dashboard.vue'
import Category from '../views/Category.vue'

Vue.use(VueRouter)

const routes = [{
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/about',
        name: 'About',
        component: About
    },
    {
        path: '/contact',
        name: 'Contact',
        component: Contact
    },
    {
        path: '/post',
        name: 'post',
        component: Post,
        meta: { authOnly: true }
    },
    {
        path: '/post/:postSlug',
        name: 'post.show',
        component: Show
    },
    {
        path: '/post-create',
        name: 'post.create',
        component: Create
    },
    {
        path: '/post/:postSlug/edit',
        name: 'post.edit',
        component: Edit
    },
    {
        path: '/post/:postSlug/edit',
        name: 'post.delete',
        component: Delete,
        props: true
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: { guestOnly: true }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: { guestOnly: true }
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: { authOnly: true }
    },
    {
        path: '/category',
        name: 'category',
        component: Category
    }

]

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    base: process.env.BASE_URL,
    routes
})

function isLoggedIn() {
    return localStorage.getItem("auth");
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.authOnly)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!isLoggedIn()) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else if (to.matched.some(record => record.meta.guestOnly)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (isLoggedIn()) {
            next({
                path: '/dashboard',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
})

export default router