<template>
    <div class="content__header">
        <a href="#" class="content__header__open-menu">
            <img src="/images/icons/menu.svg" alt="menu" />
        </a>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">
                    <img src="/images/icons/home-2.svg" alt="home" />
                    <span> پنل کاربری</span>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">داشبورد</li>
        </ul>
        <div class="content__header__actions">
            <router-link :to="{name:'tickets'}">
                <img src="/images/icons/messages.svg" alt="tickets" />
                <span>4</span>
            </router-link>

            <router-link :to="{name:'notifications'}">
                <img
                    src="/images/icons/notification-bing.svg"
                    alt="notifications"
                />
                <span>1</span>
            </router-link>
            <a href="#">
                <img src="/images/icons/exit.svg" alt="exit"/>
            </a>

        </div>

    </div>
</template>

<script>
export default {
    name: "headerPages"
}
</script>

<style scoped>

</style>