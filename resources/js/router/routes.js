import Dashboard from "../layouts/Dashboard.vue";
import {createWebHistory,createRouter} from 'vue-router'
import Service from "../layouts/Service.vue";
import Orders from "../layouts/Orders.vue";
import Tickets from "../layouts/Tickets.vue";
import Notifications from "../layouts/Notifications.vue";
import profile from "../layouts/Profile.vue";
const routes = [
    {
        path:'/',
        name:'panel',
        component:Dashboard
    },
    {
        path:'/service',
        name:'service',
        component:Service
    },
    {
        path:'/orders',
        name:'Orders',
        component:Orders
    },
    {
        path:'/tickets',
        name:'tickets',
        component:Tickets
    },
    {
        path:'/notifications',
        name:'notifications',
        component:Notifications
    },
    {
        path:'/profile',
        name:'profile',
        component:profile
    },
]
const route = createRouter({
    history:createWebHistory(),
    routes
})

export default route