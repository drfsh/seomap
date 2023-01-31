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
        <div class="sidebar__body" style="background: rgb(246 246 246);border: 1px solid #2f5bea;">
            <div class="sidebar__body__avatar">
                <img :src="user.profile" alt="avatar"/>
            </div>
            <div class="sidebar__body__user">
                <div class="sidebar__body__user__name">{{ user.name }}</div>
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
                    <Link :class="{active:$page.component==='Admin/Dashboard'}" :href="route('admin')">
                        <ic_dashboard></ic_dashboard>
                        پنل مدیریت
                    </Link>
                </li>

                <li>
                    <Link :class="{
                        active:($page.component==='Admin/Users'||
                        $page.component==='Admin/UserEdit'||
                        $page.component==='Admin/UserCreate')
                    }" :href="route('admin.users')">
                        <ic_user_edit></ic_user_edit>
                        کاربران
                    </Link>
                </li>
                <li>
                    <Link :class="{active:($page.component==='Admin/Services'||
                    $page.component==='Admin/ServiceCreate'||
                    $page.component==='Admin/ServiceEdit')}" :href="route('admin.services')">
                        <ic_list></ic_list>
                        سرویس ها
                    </Link>
                </li>

                <li>
                    <Link :class="{active:($page.component==='Admin/Orders'||
                    $page.component==='Admin/Order')}" :href="route('admin.orders')">
                        <ic_list_search></ic_list_search>
                        پیگیری سفارشات
                        <div class="count" style="animation: pulse-primary 2s infinite;" v-if="alerts.projects">{{alerts.projects}}</div>
                    </Link>
                </li>

                <li>
                    <Link :class="{active:($page.component==='Admin/Tickets'||$page.component==='Admin/Ticket')}"
                          :href="route('admin.tickets')">
                        <ic_chats></ic_chats>
                        پشتیبانی
                        <div class="count" style="animation: pulse-primary 2s infinite;" v-if="alerts.tickets">{{alerts.tickets}}</div>
                    </Link>
                </li>
                <li>
                    <Link :class="{active:($page.component==='Admin/Notifications'||
                    $page.component==='Admin/Notification')}" :href="route('admin.notifications')">
                        <ic_bell></ic_bell>
                        اعلان ها
                    </Link>
                </li>


            </ul>

            <Link style="margin: auto;margin-top: 25px;" method="POST" as="button"  :href="route('logout')" class="sidebar__body__logout border-0 bg-transparent">خروج از
                حساب کاربری
            </Link>
        </div>

    </div>

</template>

<script setup>
import Ic_dashboard from "../../svgs/ic_dashboard.vue";
import Ic_list from "../../svgs/ic_list.vue";
import Ic_list_search from "../../svgs/ic_list_search.vue";
import Ic_bell from "../../svgs/ic_bell.vue";
import Ic_chats from "../../svgs/ic_chats.vue";
import {Link, usePage} from '@inertiajs/inertia-vue3';
import {onMounted, onUnmounted, ref, watch} from "vue";
import Ic_user_edit from "@/Components/svgs/ic_user_edit.vue";
const alerts = ref({projects:0,tickets:0})
const user = usePage().props.value.auth.user;
const menuShow = ref(false)
let timer = null
onMounted(async () => {
    let {data} = await axios.get(route('admin.infoSlider'))
    alerts.value = data.data
    console.log(alerts.value)
    timer = setInterval(() => {
        if (window.menuShow) {
            menuShow.value = true
            window.menuShow = false
        }
    }, 0)
})
onUnmounted(() => {
    clearInterval(timer)
    document.body.classList.remove('onSlide')
})
watch(menuShow, (v) => {
    if (v == true) {
        document.body.classList.add('onSlide')
    } else
        document.body.classList.remove('onSlide')
})
</script>
