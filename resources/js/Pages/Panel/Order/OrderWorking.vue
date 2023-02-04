<template>


    <div class="order-detail">
        <div class="min-title mt-0">توضیحات مشتری</div>
        <div class="order-detail mt-3">
            <p class="order-info ">
                {{ project.description }}
            </p>
        </div>

        <div class="min-title">امکانات</div>
        <div class="row mt-4 m-0 px-2 order-detail">
            <div v-for="v in attrs.attr" class="mb-4 col-12 col-md-6 col-xl-3 col-lg-6">
                <ic_tick_blue></ic_tick_blue>
                <strong style="font-size: 13px"> &nbsp; {{ v.description }} </strong>
            </div>
        </div>
    </div>


    <div class="position-relative">
        <span class="data-left" style="right: unset; left: 17px; top: -1px;">
                    {{attrs.startDescription[0].created_at_fa}}
        </span>
        <div class="min-title">توضیحات کارشناس فنی</div>
        <div class="order-detail mt-3 order-info" v-html="prop.attrs.startDescription[0].description"></div>
        <div class="order-detail mt-3 order-info" v-html="prop.attrs.setupDescription[0].description"></div>

    </div>
</template>

<script setup>
import moment from 'jalali-moment'
import {onMounted, onUnmounted, ref} from "vue";
import Loading from "@/Components/Loading.vue";
import Ic_tick_blue from "@/Components/svgs/ic_tick_blue.vue";

const prop = defineProps(['attrs', 'project'])



</script>
