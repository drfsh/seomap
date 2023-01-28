<template>

    <div>
        <div class="min-title mb-3">وضعیت</div>
        <div class="statuses">
            <div class="titles">
                <div class="attrs" style="flex-wrap: nowrap">
                    <div class="item" @click="attrs.startInfo?page=0:undefined" :class="{active:page===0}" style="white-space: nowrap" role="button">
                        <div class="order-detail__item">
                    <span>
                        <img src="/images/icons/receipt-2.svg" alt="">
                        مرحله :
                    </span>
                            <strong class="me-2">شروع</strong>
                            <ic_tick_green v-if="sentAllAttrs && attrs.startAttrs" class="icon"></ic_tick_green>
                            <ic_tick class="icon" v-else-if="attrs.startInfo"></ic_tick>
                        </div>
                    </div>
                </div>
                <div class="attrs" style="flex-wrap: nowrap">
                    <div class="item"  @click="attrs.demoCheck?page=1:undefined" :class="{active:page===1}"  style="white-space: nowrap" role="button">
                        <div class="order-detail__item">
                    <span>
                        <img src="/images/icons/receipt-2.svg" alt="">
                        مرحله :
                    </span>
                            <strong class="me-2">بررسی</strong>
                            <ic_tick_green v-if="attrs.demoCheck && attrs.demoCheck[0].name" class="icon"></ic_tick_green>
                            <ic_tick class="icon" v-else-if="attrs.demoCheck"></ic_tick>
                        </div>
                    </div>
                </div>
                <div class="attrs" style="flex-wrap: nowrap">
                    <div class="item"  @click="attrs.demoTest?page=2:undefined" :class="{active:page===2}"  style="white-space: nowrap" role="button">
                        <div class="order-detail__item">
                    <span>
                        <img src="/images/icons/receipt-2.svg" alt="">
                        مرحله :
                    </span>
                            <strong class="me-2">تست</strong>
                            <ic_tick_green v-if="attrs.demoTest && attrs.demoTest[0].name" class="icon"></ic_tick_green>
                            <ic_tick class="icon" v-else-if="attrs.demoTest"></ic_tick>
                        </div>
                    </div>
                </div>
                <div class="attrs" style="flex-wrap: nowrap">
                    <div class="item"  @click="attrs.finish?page=3:undefined" :class="{active:page===3}"  style="white-space: nowrap" role="button">
                        <div class="order-detail__item">
                    <span>
                        <img src="/images/icons/receipt-2.svg" alt="">
                        مرحله :
                    </span>
                            <strong class="me-2">تحویل</strong>
                            <ic_tick_green v-if="attrs.finish && attrs.finish[0].name"
                                           class="icon"></ic_tick_green>
                            <ic_tick class="icon" v-else-if="attrs.finish"></ic_tick>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100">
                <OrderAttrsStart :attrs="attrs" :project="project" v-if="page===0"></OrderAttrsStart>
                <OrderAttrsCheck :attrs="attrs" :project="project" v-if="page===1"></OrderAttrsCheck>
                <OrderAttrsTest :attrs="attrs" :project="project" v-if="page===2"></OrderAttrsTest>
                <OrderAttrsFinish :attrs="attrs" :project="project" v-if="page===3"></OrderAttrsFinish>
            </div>
        </div>
    </div>


    <div v-if="attrs.processing && false" class="attrs" style="flex-wrap: nowrap;">
        <div class="item" style="white-space: nowrap" @click="changeProcessingName" role="button">
            <div class="order-detail__item">
                                  <span>
                                    <img src="/images/icons/receipt-2.svg" alt="">
                                    مرحله :
                                  </span>
                <strong> {{ attrs.processing[0].name }}</strong>
            </div>
        </div>
        <div class="item processing" @click="changeProcessing"
             :style="'--proccess:'+attrs.processing[0].value+'%'" role="button">
            <div class="order-detail__item" style="z-index: 6;position: relative;">
                                  <span>
                                    <img src="/images/icons/receipt-disscount.svg" alt="">
                                    پیشروی :
                                  </span>
                <strong>% {{ attrs.processing[0].value }} </strong>
            </div>
        </div>
    </div>

</template>

<script setup>

import Ic_tick_green from "@/Components/svgs/ic_tick_green.vue";
import Ic_tick from "@/Components/svgs/ic_tick.vue";

import {ref} from "vue";
import OrderAttrsStart from "@/Pages/Panel/Order/OrderAttrsStart.vue";
import OrderAttrsCheck from "@/Pages/Panel/Order/OrderAttrsCheck.vue";
import OrderAttrsTest from "@/Pages/Panel/Order/OrderAttrsTest.vue";
import OrderAttrsFinish from "@/Pages/Panel/Order/OrderAttrsFinish.vue";
const page = ref(0)
const sentAllAttrs = ref(true)
const prop = defineProps(['attrs', 'project'])
const startAttrs = prop.attrs.startAttrs


if ((prop.attrs.sentAllAttrs && prop.attrs.startAttrs)||prop.attrs.startInfo){
    page.value=0
}
if (prop.attrs.demoCheck){
    page.value=1
}
if (prop.attrs.demoTest){
    page.value=2
}

if (prop.attrs.finish){
    page.value=3
}
for (const i in startAttrs) {
    if (startAttrs[i].value==null&&startAttrs[i].description==null){
        sentAllAttrs.value = false
    }
}
const changeProcessing = () => {
    let person = prompt("درصد را وارد کنید")
    if (person == null || person == "") {

    } else {
        prop.attrs.processing[0].value = person
        axios.post(route('admin.order.attr.edit', {id: prop.attrs.processing[0].project_id}), {
            type: 'processing',
            name: prop.attrs.processing[0].name,
            value: person,
            des: "0",
        })
    }
}
const changeProcessingName = () => {
    let person = prompt("مرحله را وارد کنید")
    if (person == null || person == "") {

    } else {
        prop.attrs.processing[0].name = person
        axios.post(route('admin.order.attr.edit', {id: prop.attrs.processing[0].project_id}), {
            type: 'processing',
            name: person,
            value: prop.attrs.processing[0].value,
            des: "0",
        })
    }
}
const addAttr = (type) => {

    let name = prompt("نام ویژگی")
    if (name == null || name == "") return
    let des = prompt("مقدار ویژگی")
    if (des == null || des == "") return;


    if (prop.attrs[type] == null || prop.attrs[type] == undefined)
        prop.attrs[type] = []

    let data = {
        type: type,
        name: name,
        value: '0',
        description: des,
        project_id: prop.project.id,
    }
    prop.attrs[type].push(data)
    axios.post(route('admin.order.attr.store'), data)

}
const startProcessing = () => {
    let type = 'processing'
    let name = prompt("مرحله را وارد کنید")
    if (name == null || name == "") return
    let des = prompt("درصد پیشرفت")
    if (des == null || des == "") return;


    if (prop.attrs[type] == null || prop.attrs[type] == undefined)
        prop.attrs[type] = []

    let data = {
        type: type,
        name: name,
        value: des,
        description: "0",
        project_id: prop.project.id,
    }
    prop.attrs[type].push(data)
    axios.post(route('admin.order.attr.store'), data)

}

</script>
