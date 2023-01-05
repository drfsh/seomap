<template>
    <main class="container py-4 rtl">
        <div class="row">
            <Slider></Slider>
            <div class="content">
                <header-pages></header-pages>
                <router-view></router-view>
                <FooterPages></FooterPages>
            </div>
        </div>
    </main>
</template>

<script>
import Slider from "./components/global/Slider.vue";
import FooterPages from "./components/global/FooterPages.vue";
import HeaderPages from "./components/global/headerPages.vue";
export default {
    name: "App",
    components: {HeaderPages, FooterPages, Slider}
}
</script>

<style scoped>

</style>