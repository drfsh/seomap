<template>
    <div class="sidebar close">
        <div class="sidebar__head">
            <a href="#" class="sidebar__head__close-menu">
                <img src="/images/icons/close.svg" alt=""/>
            </a>
            <div class="sidebar__head__logo">
                <img src="#/images/logo.png" alt="logo"/>
            </div>
            <div class="">
                <img src="/images/icons/menu-ham.svg" alt="logo"/>
            </div>
        </div>
        <div class="sidebar__body">
            <div class="sidebar__body__avatar">
                <img src="/images/temp/avatar.png" alt="avatar"/>
            </div>
            <div class="sidebar__body__user">
                <div class="sidebar__body__user__name"> کاربر جدید سایت</div>
                <hr/>
                <div class="sidebar__body__user__balance">
                    <span> اطلاعات حساب کاربری</span>
                    <Link :href="route('profile.edit')" class="increase"
                    ><img
                        src="/images/icons/edit-user.svg"
                        alt="increase balance"
                    /></Link>
                </div>
            </div>

            <ul class="sidebar__body__links">
                <li>
                    <Link :class="{active:$page.component==='Panel/Dashboard'}" :href="route('dashboard.view')">
                        <ic_dashboard></ic_dashboard>
                        داشبورد
                    </Link>
                </li>

                <li>
                    <Link :class="{active:$page.component==='Panel/Service'}" :href="route('service')">

                        <ic_list></ic_list>
                        ثبت سفارش
                    </Link>
                </li>
                <li>
                    <Link :class="{active:$page.component==='Panel/Orders'}" :href="route('orders.view')">
                        <ic_list_search></ic_list_search>
                        پیگیریسفارش
                    </Link>
                </li>

                <li>
                    <Link :class="{active:$page.component==='Panel/Tickets'}" :href="route('ticket.list')">
                        <ic_chats></ic_chats>
                        پشتیبانی
                    </Link>
                </li>

                <li>
                    <Link :class="{active:$page.component==='Panel/Notifications'}" :href="route('notification.list')">
                        <ic_bell></ic_bell>
                        اعلان ها
                    </Link>
                </li>


            </ul>

            <a href="#" class="sidebar__body__logout">خروج از حساب کاربری</a>
        </div>

    </div>

</template>

<script setup>
import Ic_dashboard from "../svgs/ic_dashboard.vue";
import Ic_list from "../svgs/ic_list.vue";
import Ic_list_search from "../svgs/ic_list_search.vue";
import Ic_bell from "../svgs/ic_bell.vue";
import Ic_chats from "../svgs/ic_chats.vue";
import {Link} from '@inertiajs/inertia-vue3';
</script>
