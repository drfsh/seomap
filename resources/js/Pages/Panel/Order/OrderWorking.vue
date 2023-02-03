<template>
    <div v-if="p!=null" class="table-container mt-3">
        <div class="min-title mt-0 mb-4 me-0">خط زمانی پایان پروژه</div>
        <div class="deadline">
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
                <span v-if="getAttrs!=null" class="get-attrs" :style="{'--p':getAttrs.p+'%'}">

                </span>
                <span v-if="demoCheck!=null" class="get-attrs" :style="{'--p':demoCheck.p+'%'}" style="background: #24fc14">

                </span>
                <span v-if="demoTest!=null" class="get-attrs" :style="{'--p':demoTest.p+'%'}" style="    right: calc(var(--p) - 7px);background: #0dcaf0">

                </span>
            </div>
            <span class="left">
                {{ dataFormat(end, 'DD MMMM') }}
            </span>
        </div>
        <div class="color-type">
            <div v-if="getAttrs">دریافت اطلاعات سایت: {{dataFormat(getAttrs.date, 'DD MMMM')}}</div>
            <div v-if="demoCheck">بررسی سایت: {{dataFormat(demoCheck.date, 'DD MMMM')}}</div>
            <div v-if="demoTest">تست نهایی سایت: {{dataFormat(demoTest.date, 'DD MMMM')}}</div>
        </div>
        <div v-if="attrs.pMessage">
            <div>
                <div class="min-title">پیام ها</div>

                <div v-for="v in attrs.pMessage" class="row m-0  py-4 mt-4 px-4 order-detail position-relative">
                    <span class="data-left">{{ v.created_at_fa }}</span>
                    {{ v.description }}
                </div>
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

    <div>
        <div class="min-title">توضیحات مشتری</div>
        <div class="order-detail mt-3">
            <p class="order-info">
                {{ project.description }}
            </p>
        </div>
    </div>

    <div v-if="attrs.attr">
        <div class="min-title">امکانات</div>
        <div class="row mt-4 m-0 px-2 order-detail">
            <div v-for="v in attrs.attr" class="mb-4 col-12 col-md-6 col-xl-3 col-lg-6">
                <ic_tick_blue></ic_tick_blue>
                <strong style="font-size: 13px"> &nbsp; {{ v.description }} </strong>
            </div>
        </div>
    </div>

</template>

<script setup>
import moment from 'jalali-moment'
import {onMounted, onUnmounted, ref} from "vue";
import Loading from "@/Components/Loading.vue";
import Ic_tick_blue from "@/Components/svgs/ic_tick_blue.vue";

const prop = defineProps(['attrs', 'project'])

function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}

let start ,end, today;
const n = ref(null)
const p = ref(null)
const getAttrs = ref(null)
const demoCheck = ref(null)
const demoTest = ref(null)
const fu = () => {
    const attrs = prop.attrs.startDate

    start = new Date(attrs[0].created_at)
    end = addDays(start, prop.project.days)
    today = new Date();

    if (prop.attrs.demoCheck) {
        const date = new Date(new Date(prop.attrs.demoCheck[0].updated_at))
        demoCheck.value = {
            date: date,
            p: Math.round(((date - start) / (end - start)) * 100)
        }
    }
    else {
        demoCheck.value = null
    }

    if (prop.attrs.demoTest) {
        const date = new Date(new Date(prop.attrs.demoTest[0].updated_at))
        demoTest.value = {
            date: date,
            p: Math.round(((date - start) / (end - start)) * 100)
        }
    }
    else {
        demoCheck.value = null
    }
    getAttrs.value = null
    const startAttr = prop.attrs.startAttrs
    for (const i in startAttr) {
        if (startAttr[i].value!=null||startAttr[i].description!=null){
            const date = new Date(new Date(startAttr[i].updated_at))
            getAttrs.value = {
                date:date,
                p:Math.round(((date - start) / (end - start)) * 100)
            }
        }
    }

    n.value = (Math.round((end - today) / 1000 / 60 / 60 / 24))
    p.value = Math.round(((today - start) / (end - start)) * 100)
    if (p.value>100)
        p.value=100
}
fu()
const timer = setInterval(()=>{
    fu()
},1000)
onUnmounted(()=>{
    clearInterval(timer)
})
const dataFormat = (date, format) => {
    return moment(date, 'YYYY-MM-DDTH:mm:ss.000000Z').locale('fa').format(format)
}


</script>
