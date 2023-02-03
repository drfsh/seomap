<template>
    <div class="attrs" style="flex-wrap: nowrap;min-height: 100%">
        <div class="item w-100" style=";padding: 20px">
            <div v-if="prop.attrs.demo[0].value2==true" class="row">
                <div class="col-lg-6 mt-4"
                     style="z-index: 6;position: relative">
                    <div class="col-12">
                        <div class="input-group">
                            <input v-model="form.web" type="text" class="form-control" placeholder="آدرس سایت">
                        </div>
                        <InputError :message="form.errors.web"></InputError>
                    </div>
                </div>
                <div class="col-lg-6 mt-4">
                    <div class="input-group">
                        <img src="/images/icons/user.svg" class="me-2">
                        <input type="text" v-model="form.web_user"
                               style="border-left: 1px solid antiquewhite;margin-left: 11px" class="form-control"
                               placeholder="user"><br>
                        <img src="/images/icons/eye.svg" alt="">
                        <input type="text" v-model="form.web_pass" class="form-control ms-1" placeholder="password">
                    </div>
                </div>
                <div class="col-lg-6 mt-4"
                     style="z-index: 6;position: relative">
                    <div class="col-12">
                        <div class="input-group">
                            <input v-model="form.host" type="text" class="form-control" placeholder="آدرس هاست">
                        </div>
                        <InputError :message="form.errors.host"></InputError>
                    </div>
                </div>
                <div class="col-lg-6 mt-4">
                    <div class="input-group">
                        <img src="/images/icons/user.svg" class="me-2">
                        <input type="text" v-model="form.host_user"
                               style="border-left: 1px solid antiquewhite;margin-left: 11px" class="form-control"
                               placeholder="user"><br>
                        <img src="/images/icons/eye.svg" alt="">
                        <input type="text" v-model="form.host_pass" class="form-control ms-1" placeholder="password">
                    </div>
                </div>
                <div class="col-lg-6 mt-4"
                     style="z-index: 6;position: relative">
                    <div class="col-12">
                        <div class="input-group">
                            <input v-model="form.email_info.email" type="email" class="form-control"
                                   placeholder="آدرس ایمیل سازمانی">
                        </div>
                        <InputError :message="form.errors.email_info"></InputError>
                    </div>
                </div>
                <div class="col-lg-6 mt-4">
                    <div class="input-group">
                        <img src="/images/icons/user.svg" class="me-2">
                        <input type="text" v-model="form.email_info.username"
                               style="border-left: 1px solid antiquewhite;margin-left: 11px" class="form-control"
                               placeholder="user"><br>
                        <img src="/images/icons/eye.svg" alt="">
                        <input type="text" v-model="form.email_info.password" class="form-control ms-1" placeholder="password">
                    </div>
                </div>
                <div class="col-lg-6 mt-4"
                     style="z-index: 6;position: relative">
                    <div class="col-12">
                        <div class="input-group">
                            <input v-model="form.email_admin.email" type="email" class="form-control"
                                   placeholder="آدرس ایمیل ادمین">
                        </div>
                        <InputError :message="form.errors.email_admin"></InputError>
                    </div>
                </div>
                <div class="col-lg-6 mt-4">
                    <div class="input-group">
                        <img src="/images/icons/user.svg" class="me-2">
                        <input type="text" v-model="form.email_admin.username"
                               style="border-left: 1px solid antiquewhite;margin-left: 11px" class="form-control"
                               placeholder="user"><br>
                        <img src="/images/icons/eye.svg" alt="">
                        <input type="text" v-model="form.email_admin.password" class="form-control ms-1" placeholder="password">
                    </div>
                </div>
                <div class="mt-4"
                     style="z-index: 6;position: relative">
                    <div class="col-12">
                        <div class="input-group">
                            <textarea style="height: 150px;" v-model="form.description" type="text" class="form-control"
                                      placeholder="توضیحات"></textarea>
                        </div>
                        <InputError :message="form.errors.description"></InputError>
                    </div>
                </div>
                <div v-if="project.status===4" class="mt-3 text-start">
                    <button @click="setStatus" style="padding: 11px 18px;" class="me-2 btn btn--primary outline">
                        <b v-if="!form.processing">
                            پایان پروژه
                        </b>
                        <Loading v-else color="#2f5bea"></Loading>
                    </button>
                </div>
            </div>
            <div v-else>
                <div class="order-detail__item "
                     style="z-index: 6;position: relative">
                    <ic_info class="ms-2"></ic_info>
                    {{ prop.attrs.demo[0].value2 == true ? 'دمو تایید شده' : 'کاربر درحال برسی دمو میباشد!' }}
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
                        <span :data-title="dataFormat(getAttrs.date, 'DD MMMM')" v-if="getAttrs!=null" class="get-attrs"
                              :style="{'--p':getAttrs.p+'%'}">

                </span>
                        <span :data-title="dataFormat(demoCheck.date, 'DD MMMM')" v-if="demoCheck!=null"
                              class="get-attrs" :style="{'--p':demoCheck.p+'%'}">

                </span>
                        <span :data-title="dataFormat(demoTest.date, 'DD MMMM')" v-if="demoTest!=null" class="get-attrs"
                              :style="{'--p':demoTest.p+'%'}">

                </span>
                    </div>
                    <span class="left">
                {{ dataFormat(end, 'DD MMMM') }}
            </span>
                </div>

            </div>
        </div>
    </div>
</template>

<script setup>
import Loading from "@/Components/Loading.vue";
import VueTagsInput from "@sipec/vue3-tags-input";
import {onMounted, onUnmounted, ref} from "vue";
import Ic_circle from "@/Components/svgs/ic_circle.vue";
import Ic_document_tick from "@/Components/svgs/ic_document_tick.vue";
import Ic_list from "@/Components/svgs/ic_list.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import Ic_tick_blue from "@/Components/svgs/ic_tick_blue.vue";
import InputError from "@/Components/InputError.vue";
import Ic_info from "@/Components/svgs/ic_info.vue";
import moment from "jalali-moment";

const prop = defineProps(['attrs', 'project'])
const page = ref(0)
let email_info = {email:null,password:null,username:null}
let email_admin = {email:null,password:null,username:null}

if (prop.attrs.finish){
    email_info = JSON.parse(prop.attrs.finish[0].value)
    email_admin = JSON.parse(prop.attrs.finish[0].value2)
}

const form = useForm({
    web: prop.project.access ? prop.project.access.web : null,
    web_user: prop.project.access ? prop.project.access.web_username : null,
    web_pass: prop.project.access ? prop.project.access.web_password : null,
    host: prop.project.access ? prop.project.access.host : null,
    host_pass: prop.project.access ? prop.project.access.host_password : null,
    host_user: prop.project.access ? prop.project.access.host_username : null,
    email_info: email_info,
    email_admin: email_admin,
    description: prop.attrs.finish ? prop.attrs.finish[0].description : null,
    project_id: prop.project.id,

})
console.log(prop.attrs.finish)
const setStatus = async () => {
    form.post(route('admin.order.finish'), {
        onSuccess: () => {
            location.reload()
        }
    })
}

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
