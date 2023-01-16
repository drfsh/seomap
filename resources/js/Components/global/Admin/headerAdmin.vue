<template>
    <div class="content__header">
        <a href="#" @click="showMenu" class="content__header__open-menu">
            <img src="/images/icons/menu.svg" alt="menu" />
        </a>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <Link href="/">
                    <img src="/images/icons/home-2.svg" alt="home" />
                    <span> پنل کاربری</span>
                </Link>
            </li>
            <li class="breadcrumb-item active" aria-current="page">پنل مدیریت</li>
        </ul>
        <div class="content__header__actions">

            <Link :href="route('logout')" method="post">
                <img src="/images/icons/exit.svg" alt="exit"/>
            </Link>

        </div>

    </div>
</template>

<script setup>
import {Link} from '@inertiajs/inertia-vue3';
const showMenu = () => {
  window.menuShow = true
}
</script>

<style scoped>

</style>
