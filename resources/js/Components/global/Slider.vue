<template>
    <div class="sidebar" :class="{close:!menuShow}">
        <div class="sidebar__head">
            <a @click="menuShow=!menuShow" class="sidebar__head__close-menu">
                <img src="/images/icons/close.svg" alt=""/>
            </a>
            <div class="sidebar__head__logo">
                <img src="/images/logo.svg" alt="logo"/>
            </div>
        </div>
        <div class="sidebar__body">
            <div class="sidebar__body__avatar">
                <img :src="user.profile" alt="avatar"/>
            </div>
            <div class="sidebar__body__user">
                <div class="sidebar__body__user__name">{{user.name}}</div>
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
                    <Link :class="{active:$page.component==='Panel/Dashboard'}" :href="route('dashboard')">
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
                <li class="position-relative">
                    <Link :class="{active:$page.component==='Panel/Orders'}" :href="route('orders.list')">
                        <ic_list_search></ic_list_search>
                        پیگیری سفارش
                        <div class="count" style="animation: pulse-primary 2s infinite;" v-if="cAlert.projects"></div>
                    </Link>
                </li>

                <li>
                    <Link :class="{active:$page.component==='Panel/Tickets'}" :href="route('ticket.list')">
                        <ic_chats></ic_chats>
                        پشتیبانی
                    </Link>
                </li>

                <li>
                    <Link :class="{active:(($page.component==='Panel/Notifications'||
                    $page.component==='Panel/Notification'))}" :href="route('notification.list')">
                        <ic_bell></ic_bell>
                        اعلان ها
                    </Link>
                </li>


            </ul>

            <Link method="post" :href="route('logout')" class="sidebar__body__logout">خروج از حساب کاربری</Link>
        </div>

    </div>

</template>

<script setup>
import Ic_dashboard from "../svgs/ic_dashboard.vue";
import Ic_list from "../svgs/ic_list.vue";
import Ic_list_search from "../svgs/ic_list_search.vue";
import Ic_bell from "../svgs/ic_bell.vue";
import Ic_chats from "../svgs/ic_chats.vue";
import {Link, usePage} from '@inertiajs/inertia-vue3';
import {onMounted, onUnmounted, ref, watch} from "vue";
const user = usePage().props.value.auth.user;
const menuShow = ref(false)

watch(menuShow, (v) => {
    if (v == true) {
        document.body.classList.add('onSlide')
    } else
        document.body.classList.remove('onSlide')
})
const cAlert = ref({projects:false})
let timer = null
onMounted(async () => {
    let {data} = await axios.get(route('infoSlider'))
    cAlert.value = data.data
    timer = setInterval(() => {
        if (window.menuShow) {
            menuShow.value = true
            window.menuShow = false
        }
    }, 0)
})
onUnmounted(()=>{
    document.body.classList.remove('onSlide')
    clearInterval(timer)

})
</script>
