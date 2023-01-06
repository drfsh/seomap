<script setup>
import Slider from '@/Components/global/Slider.vue';
import HeaderPages from '@/Components/global/headerPages.vue';
import FooterPages from '@/Components/global/FooterPages.vue';
</script>
<template>
    <main class="container py-4 rtl">
        <div class="row">
            <Slider></Slider>
            <div class="content">
                <HeaderPages></HeaderPages>
                <slot />
                <FooterPages></FooterPages>
            </div>
        </div>
    </main>
</template>

