<template>
    <Alert v-if="attrs.demo[0].value1" class="mb-2" message="درحال انجام تنظیمات نهایی میباشیم. در کوتاه ترین زمان اطلاعات تکمیلی را ارسال خواهیم کرد"></Alert>
    <div class="order-detail mt-3">
        <div style="font-weight: 500;">
            <ic_list class="mx-2"></ic_list>
            جناب <a :href="route('profile.edit')">{{project.user.name}}</a>
            مرحله تست پروژه شما به شرح زیر میباشد
        </div>
        <div class="mt-5 position-relative">
            <div class="">لینک دمو پروژه:</div>
            <div class="order-detail mt-3 order-info">
                <a target="_blank" :href="prop.attrs.demo[0].value">{{prop.attrs.demo[0].value}}</a>
            </div>
        </div>
        <div class="mt-5 position-relative">
            <span class="data-left" style="right: unset; left: 17px; top: -1px;">
                        {{attrs.demo[0].created_at_fa}}
            </span>
            <div class="">توضیحات کارشناس فنی</div>
            <div class="order-detail mt-3 order-info" v-html="prop.attrs.demo[0].description"></div>
        </div>

        <div v-if="!attrs.demo[0].value1">
            <div class="order-detail__item mt-5"
                 style="z-index: 6;position: relative">
                <ic_info class="ms-2"></ic_info>
                7 روز زمان تست
            </div>
            <div class="mt-3 deadline">

            <span class="right">
                {{ dataFormat(start, 'DD MMMM') }}
            </span>
                <div class="line" :style="{'--p':p+'%'}">
                <span v-if="n>0" class="title">
                    {{ n + ' روز مانده ' }}
                </span>
                    <span v-else class="title">
                    روز آحر
                </span>
                </div>
                <span class="left">
                {{ dataFormat(end, 'DD MMMM') }}
            </span>
            </div>
            <div v-if="project.status===4" class="mt-5 text-start">
                <a :href="route('order.finish',{id:project.id})">
                    <button style="padding: 11px 18px;" class="me-2 btn btn--primary">
                        تایید و پرداخت هزینه پایانی
                    </button>
                </a>
            </div>
        </div>
    </div>

</template>

<script setup>
import Ic_list from "@/Components/svgs/ic_list.vue";
import {onUnmounted, ref} from "vue";
import moment from "jalali-moment";
import Ic_info from "@/Components/svgs/ic_info.vue";
import Alert from "@/Components/Alert.vue";
const prop = defineProps(['attrs','project'])


function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}

let start, end, today;
const n = ref(null)
const p = ref(null)
const getAttrs = ref(null)
const demoCheck = ref(null)
const demoTest = ref(null)
const fu = () => {
    const attrs = prop.attrs.demo

    start = new Date(attrs[0].created_at)
    end = addDays(start, 7)
    today = new Date();

    if (prop.attrs.demoCheck) {
        const date = new Date(new Date(prop.attrs.demoCheck[0].updated_at))
        demoCheck.value = {
            date: date,
            p: Math.round(((date - start) / (end - start)) * 100)
        }
    } else {
        demoCheck.value = null
    }

    if (prop.attrs.demoTest) {
        const date = new Date(new Date(prop.attrs.demoTest[0].updated_at))
        demoTest.value = {
            date: date,
            p: Math.round(((date - start) / (end - start)) * 100)
        }
    } else {
        demoCheck.value = null
    }
    getAttrs.value = null
    const startAttr = prop.attrs.startAttrs
    for (const i in startAttr) {
        if (startAttr[i].value != null || startAttr[i].description != null) {
            const date = new Date(new Date(startAttr[i].updated_at))
            getAttrs.value = {
                date: date,
                p: Math.round(((date - start) / (end - start)) * 100)
            }
        }
    }

    n.value = (Math.round((end - today) / 1000 / 60 / 60 / 24))
    p.value = Math.round(((today - start) / (end - start)) * 100)
    if (p.value > 100)
        p.value = 100
}
fu()
const timer = setInterval(() => {
    fu()
}, 1000)
onUnmounted(() => {
    clearInterval(timer)
})
const dataFormat = (date, format) => {
    return moment(date, 'YYYY-MM-DDTH:mm:ss.000000Z').locale('fa').format(format)
}
</script>
