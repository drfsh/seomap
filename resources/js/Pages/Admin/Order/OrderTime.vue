<template>
    <div class="min-title">زمان</div>
    <div v-if="p!=null" class="table-container mt-3">
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
                <span :data-title="dataFormat(getAttrs.date, 'DD MMMM')" v-if="getAttrs!=null" class="get-attrs" :style="{'--p':getAttrs.p+'%'}">

                </span>
                <span :data-title="dataFormat(demoCheck.date, 'DD MMMM')" v-if="demoCheck!=null" class="get-attrs" :style="{'--p':demoCheck.p+'%'}">

                </span>
                <span :data-title="dataFormat(demoTest.date, 'DD MMMM')" v-if="demoTest!=null" class="get-attrs" :style="{'--p':demoTest.p+'%'}">

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
        <div>
            <div>
                <div class="min-title">پیام ها</div>

                <div v-for="v in attrs.pMessage" class="row m-0 mt-4 px-4 order-detail position-relative">
                    <span class="data-left">{{ v.created_at_fa }}</span>
                    {{ v.description }}
                </div>
            </div>
            <div>
                <div class="mt-4 order-detail__item flex-wrap justify-content-between"
                     style="z-index: 6;position: relative">
                    <div class="col-12">
                        <div class="input-group">
                            <input v-model="text" type="text" class="form-control" placeholder="متن پیام جدید">
                        </div>
                    </div>
                </div>
                <div class=" text-end mt-2 align-self-start">
                    <button @click="addAttr('pMessage')" type="submit"
                            class="btn btn--primary outline">
                        <span>ثبت</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import moment from 'jalali-moment'
import {onMounted, onUnmounted, ref} from "vue";
import Loading from "@/Components/Loading.vue";

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
let text = ref('')
const addAttr = (type) => {

    if (text.value == null || text.value == "") return


    if (prop.attrs[type] == null || prop.attrs[type] == undefined)
        prop.attrs[type] = []

    let data = {
        type: type,
        name: 'message progress',
        value: '0',
        description: text.value,
        project_id: prop.project.id,
    }
    prop.attrs[type].push(data)
    axios.post(route('admin.order.attr.store'), data)

}
const dataFormat = (date, format) => {
    return moment(date, 'YYYY-MM-DDTH:mm:ss.000000Z').locale('fa').format(format)
}


</script>
