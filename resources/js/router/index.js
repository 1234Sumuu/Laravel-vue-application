import { createWebHistory, createRouter } from "vue-router";

import Home from '../pages/Home';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';
import Blogs from '../components/Blogs';
import EditBlog from '../components/EditBlog';
import AddBlog from '../components/AddBlog';

export const routes = [{
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'blogs',
        path: '/blogs',
        component: Blogs
    },
    {
        name: 'addblog',
        path: '/blogs/add',
        component: AddBlog
    },
    {
        name: 'editblog',
        path: '/blogs/edit/:id',
        component: EditBlog
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;