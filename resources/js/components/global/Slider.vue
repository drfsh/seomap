<template>
    <div class="sidebar close">
        <div class="sidebar__head">
            <a href="#" class="sidebar__head__close-menu">
                <img src="/images/icons/close.svg" alt="" />
            </a>
            <div class="sidebar__head__logo">
                <img src="#" alt="logo" />
            </div>
            <div class="">
                <img src="/images/icons/menu-ham.svg" alt="logo" />
            </div>
        </div>
        <div class="sidebar__body">
            <div class="sidebar__body__avatar">
                <img src="/images/temp/avatar.png" alt="avatar" />
            </div>
            <div class="sidebar__body__user">
                <div class="sidebar__body__user__name"> کاربر جدید سایت</div>
                <hr />
                <div class="sidebar__body__user__balance">
                    <span> اطلاعات حساب کاربری</span>
                    <router-link :to="{name:'profile'}" class="increase"
                    ><img
                        src="/images/icons/edit-user.svg"
                        alt="increase balance"
                    /></router-link>
                </div>
            </div>

            <ul class="sidebar__body__links">
                <li>
                    <router-link :to="{name:'panel'}">
                        <ic_dashboard></ic_dashboard>
                        داشبورد
                    </router-link>
                </li>

                <li>
                    <router-link :to="{name:'service'}">
                        <ic_list></ic_list>
                        ثبت سفارش
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name:'Orders'}">
                        <ic_list_search></ic_list_search>
                        پیگیریسفارش
                    </router-link>
                </li>

                <li>
                    <router-link :to="{name:'tickets'}">
                        <ic_chats></ic_chats>
                        پشتیبانی
                    </router-link>
                </li>

                <li>
                    <router-link :to="{name:'notifications'}">
                        <ic_bell></ic_bell>
                        اعلان ها
                    </router-link>
                </li>


            </ul>

            <a href="#" class="sidebar__body__logout">خروج از حساب کاربری</a>
        </div>
    </div>

</template>

<script>
import Ic_dashboard from "../svgs/ic_dashboard.vue";
import Ic_list from "../svgs/ic_list.vue";
import Ic_list_search from "../svgs/ic_list_search.vue";
import Ic_bell from "../svgs/ic_bell.vue";
import Ic_chats from "../svgs/ic_chats.vue";
export default {
    name: "Slider",
    components: {Ic_chats, Ic_bell, Ic_list_search, Ic_list, Ic_dashboard}
}
</script>

<style scoped>

</style>