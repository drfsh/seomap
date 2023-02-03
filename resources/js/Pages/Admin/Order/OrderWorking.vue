<template>
    <div v-if="p!=null" class="table-container mt-3">
        <div class="min-title mt-0 mb-4">خط زمانی</div>
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

                <div v-for="v in attrs.pMessage" class="row m-0 py-3 mt-4 px-4 order-detail position-relative">
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
                <div class=" text-start mt-2 align-self-start">
                    <button @click="addAttr('pMessage')" type="submit"
                            class="btn btn--primary outline">
                        <span>ثبت</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="min-title">ارسال دمو</div>
    <div class="attrs" style="flex-wrap: nowrap;min-height: 100%">
        <div class="item w-100" style=";padding: 20px">
            <div>
                <div class="mt-4"
                     style="z-index: 6;position: relative">
                    <div class="col-12">
                        <div class="input-group">
                            <input v-model="form.url" type="text" class="form-control" placeholder="آدرس">
                        </div>
                        <InputError :message="form.errors.url"></InputError>
                    </div>
                </div>
                <div class="mt-4"
                     style="z-index: 6;position: relative">
                    <div class="col-12">
                        <div class="input-group">
                            <textarea style="height: 88px;" v-model="form.info" type="text" class="form-control" placeholder="توضیحات"></textarea>
                        </div>
                        <InputError :message="form.errors.info"></InputError>
                    </div>
                </div>
                <div v-if="project.status===3" class="mt-3 text-start">
                    <button  @click="sendDemo" style="padding: 11px 18px;" class="me-2 btn btn--primary outline">
                        <b v-if="!form.processing">
                            ارسال به مشتری
                        </b>
                        <Loading v-else color="#2f5bea"></Loading>
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
import {useForm} from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";

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
const form = useForm({
    url:prop.attrs.demo?prop.attrs.demo[0].value:null,
    info:prop.attrs.demo?prop.attrs.demo[0].description:null,
    project_id:prop.project.id,
    type:'demoTest'
})
const sendDemo = async () => {
    form.post(route('admin.order.demo'),{
        onSuccess:()=>{
            location.reload()
        }
    })
}
</script>
