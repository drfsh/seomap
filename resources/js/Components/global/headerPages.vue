<template>
    <div class="content__header">
        <a @click="showMenu" class="content__header__open-menu">
            <img src="/images/icons/menu.svg" alt="menu"/>
        </a>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <Link href="/">
                    <img src="/images/icons/home-2.svg" alt="home"/>
                    <span> پنل کاربری</span>
                </Link>
            </li>
            <li class="breadcrumb-item active" aria-current="page">داشبورد</li>
        </ul>
        <div class="content__header__actions">
            <Link :href="route('admin')" v-if="user.admin">
                <img src="/images/icons/setting.svg" alt="tickets"/>
            </Link>
            <Link :href="route('ticket.list')">
                <img src="/images/icons/messages.svg" alt="tickets"/>
                <span v-if="cAlert.ticket!==0">{{cAlert.ticket}}</span>
            </Link>

            <Link :href="route('notification.list')">
                <img
                    src="/images/icons/notification-bing.svg"
                    alt="notifications"
                />
                <span v-if="cAlert.notification!==0">{{cAlert.notification}}</span>
            </Link>
            <Link :href="route('logout')" method="post">
                <img src="/images/icons/exit.svg" alt="exit"/>
            </Link>

        </div>

    </div>
</template>

<script setup>
import {Link, usePage} from '@inertiajs/inertia-vue3';
import {onMounted, ref} from "vue";
const user = usePage().props.value.auth.user;
const showMenu = () => {
    window.menuShow = true
}
const cAlert = ref({ticket:0,notification:0})
onMounted(async () => {
    let {data} = await axios.get(route('countAlert'))
    cAlert.value = data.data
})
</script>

<style scoped>

</style>
