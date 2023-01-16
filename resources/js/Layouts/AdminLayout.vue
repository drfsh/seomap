<script setup>
import HeaderAdmin from "@/Components/global/Admin/headerAdmin.vue";
import SliderAdmin from "@/Components/global/Admin/SliderAdmin.vue";
</script>
<template>
    <main class="container py-4 rtl">
        <div class="row">
            <SliderAdmin></SliderAdmin>
            <div class="content">
                <HeaderAdmin></HeaderAdmin>
                <slot />
            </div>
        </div>
    </main>
</template>

