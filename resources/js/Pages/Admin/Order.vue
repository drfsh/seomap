<template>
    <AdminLayout>
        <div class="content__card">
            <div class="content__card__head">
                <h2 class="content__card__head__title">
                    جزییات سفارش مشتری
                </h2>
                <div>
                    <a target="_blank" :href="route('admin.user.edit',{id:project.user.id})"
                       class="btn btn--outline-primary ms-2">
                        کاربر
                    </a>
                    <a v-if="project.ticket" target="_blank"
                       :href="route('admin.ticket.view',{code:project.ticket.code})"
                       class="btn btn--outline-primary ms-2">
                        تیکت
                    </a>
                    <a v-else target="_blank" :href="route('admin.ticket.create',{project:project.id})"
                       class="btn btn--outline-primary ms-2">
                        ایجاد تیکت
                    </a>
                </div>
            </div>

            <div class="content__card__body tabby">

                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link position-relative" :class="{active:page===0}" @click="page=0">
                        <ic_document_text></ic_document_text>
                        توضیحات
                    </button>
                    <button class="nav-link position-relative" :class="{active:page===1}" @click="page=1">
                        <ic_list_2></ic_list_2>
                        مراحل روند پروژه
                    </button>
                    <button class="nav-link position-relative" :class="{active:page===2}" @click="page=2">
                        <ic_tag></ic_tag>
                        پرداخت ها
                        <span v-if="dont_pay!==0" class="count">{{ dont_pay }}</span>
                    </button>
                    <button class="nav-link position-relative" :class="{active:page===3}" @click="page=3">
                        <ic_settings></ic_settings>
                        تنظیمات
                    </button>
                </div>

                <div ref="elDescription" v-show="page===0" >
                    <OrderDescription :attrs="attrs" :project="project"></OrderDescription>
                </div>
                <div ref="elAttrs" v-show="page===1">
                    <OrderAttrs :attrs="attrs" :project="project"></OrderAttrs>
                </div>
                <div ref="elInvoices" v-show="page===2" >
                    <OrderInvoices :project="project" :invoices="project.invoices"></OrderInvoices>
                </div>
                <div ref="elSettings" v-show="page===3">
                    <OrderSettings :project="project"></OrderSettings>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";

import Ic_list_2 from "@/Components/svgs/ic_list_2.vue";
import Ic_tag from "@/Components/svgs/ic_tag.vue";
import {ref, watch} from "vue";
import Ic_document_text from "@/Components/svgs/ic_document_text.vue";
import OrderAttrs from "@/Pages/Admin/Order/OrderAttrs.vue";
import OrderInvoices from "@/Pages/Admin/Order/OrderInvoices.vue";
import OrderSettings from "@/Pages/Admin/Order/OrderSettings.vue";
import OrderDescription from "@/Pages/Admin/Order/OrderDescription.vue";
import Ic_timer from "@/Components/svgs/ic_timer.vue";
import Ic_settings from "@/Components/svgs/ic_settings.vue";


const prop = defineProps({
    project: Object,
    attrs: Object,
    dont_pay: Number
})

const page = ref(prop.project.status!==0?1:0);
const elDescription = ref(null)
const elAttrs = ref(null)
const elInvoices = ref(null)
const elSettings = ref(null)
const elTime = ref(null)

watch(page,(v)=>{
    const w = window.innerWidth<600
    if (w)
    setTimeout(()=>{
        if (v===0){
            elDescription.value.scrollIntoView({behavior: 'smooth'});
        }else if (v===1){
            elAttrs.value.scrollIntoView({behavior: 'smooth'});
        }else if (v===2){
            elInvoices.value.scrollIntoView({behavior: 'smooth'});
        }else if (v===3){
            elSettings.value.scrollIntoView({behavior: 'smooth'});
        }else if (v===4){
            elTime.value.scrollIntoView({behavior: 'smooth'});
        }
    },0)
})
</script>
