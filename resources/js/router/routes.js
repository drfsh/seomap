import Dashboard from "../Pages/Panel/Dashboard.vue";
import {createWebHistory,createRouter} from 'vue-router'
import Service from "../Pages/Panel/Service.vue";
import Orders from "../Pages/Panel/Orders.vue";
import Tickets from "../Pages/Panel/Tickets.vue";
import Notifications from "../Pages/Panel/Notifications.vue";
import profile from "../Pages/Panel/Profile.vue";
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
