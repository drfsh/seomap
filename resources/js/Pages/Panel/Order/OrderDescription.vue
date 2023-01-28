<template>
    <div v-if="attrs.attr">
        <div class="min-title">امکانات</div>
        <div class="row mt-4 px-2 order-detail">
            <div v-for="v in attrs.attr" class="mb-4 col-12 col-md-6 col-xl-3 col-lg-6">
                <ic_tick_blue></ic_tick_blue>
                <strong style="font-size: 13px"> &nbsp; {{ v.description }} </strong>
            </div>
        </div>
    </div>
    <div v-if="project.file">
        <div class="min-title">فایل پیوست</div>
        <div class="order-detail mt-3">
            <a target="_blank" :href="project.file" class="order-info">
                بازکردن فایل
            </a>
        </div>
    </div>
    <div>
        <div class="min-title">توضیحات مشتری</div>
        <div class="order-detail mt-3">
            <p class="order-info">
                {{ project.description }}
            </p>
        </div>
    </div>
    <div v-if="project.attr_new && project.attr_new.example">
        <div class="min-title" v-if="project.service_id==1">نمونه سایت</div>
        <div class="order-detail mt-3">
            <p class="order-info ltr">
                {{ project.attr_new.example }}
            </p>
        </div>
    </div>
</template>

<script setup>
import Ic_tick_blue from "@/Components/svgs/ic_tick_blue.vue";

defineProps(['project','attrs'])
</script>

<style scoped>

</style>
