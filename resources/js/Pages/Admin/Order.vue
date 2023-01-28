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

                <div class="plan-" :class="{'h':project.plan.id===2,'v':project.plan.id===3,'e':project.plan.id===4}">
                    <div class="icons" v-if="project.service.id===1">
                        <img v-for="v in project.attr_new.platform.icons" :src="'/images/icons/platform/'+v+'.svg'"/>
                    </div>
                </div>

                <div class="order-detail" style="position: relative;z-index: 2;">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="order-detail__item ">
                      <span>
                        <img src="/images/icons/user1.svg" alt="">
                        نام مشتری:
                      </span>
                                <strong>&nbsp; {{ project.user.name }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order-detail__item">
                      <span>
                        <img src="/images/icons/order-list.svg" alt="">
                        شماره سفارش:
                      </span>
                                <strong>&nbsp; #{{ project.code }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order-detail__item">
                      <span>
                        <img src="/images/icons/calendar.svg" alt="">
                        تاریخ سفارش:
                      </span>
                                <strong>&nbsp;{{ project.created_at }}</strong>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="order-detail__item">
                      <span>
                        <img src="/images/icons/status.svg" alt="">
                        خدمات :
                      </span>
                                <strong> &nbsp; {{ project.service.name }} </strong>
                            </div>
                        </div>
                        <div class="col-lg-4" v-if="project.attr_new">
                            <div class="order-detail__item">
                      <span>
                        <img src="/images/icons/setting.svg" alt="">
                        نوع وب سایت :
                      </span>
                                <strong class="order-detail__item">&nbsp;{{ project.attr_new.type.name }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-4" v-if="project.service.form!==3">
                            <div class="order-detail__item">
                                  <span>
                                    <img src="/images/icons/timer.svg" alt="">
                                    مدت زمان پیاده سازی:
                                  </span>
                                <strong> &nbsp; {{ project.days }} روز کاری</strong>
                            </div>
                        </div>
                        <div class="col-lg-4" v-if="project.service.form===3 && project.access">
                            <div class="order-detail__item">
                                  <span>
                                    <img src="/images/icons/keyboard2.svg" alt="">
                                    آدرس سایت:
                                  </span>
                                <strong> &nbsp; {{ project.access.url }}</strong>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="order-detail__item">
                                  <span>
                                    <img src="/images/icons/receipt-2.svg" alt="">
                                    وضعیت سفارش:
                                  </span>
                                <strong
                                    :class="{'c-gold':project.status===0,'c-red':project.status===1||project.status===3||project.status===6||project.status===5,'c-green':project.status===2,'s-finish':project.status===4,}">
                                    &nbsp;{{ project.status_fa }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order-detail__item">
                                <span>
                                    <img src="/images/icons/wallet-money2.svg" alt="">
                                    <span v-if="project.status===0">مبلغ اولیه:</span>
                                    <span v-else>مبلغ نهایی:</span>
                                </span>
                                <strong v-if="project.fee!==0" class="text-green"> &nbsp; {{ separate(project.fee) }}
                                    تومان </strong>
                                <strong v-else class="text-green"> &nbsp; درحال برسی </strong>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order-detail__item">
                                <span>
                                    <img src="/images/icons/wallet-money-primary.svg" alt="">
                                    مبلغ پرداخت شده:
                                </span>
                                <strong class="text-green"> &nbsp; {{ separate(project.paid) }} تومان </strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nav nav-tabs mt-3" id="nav-tab" role="tablist">
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
                    <button v-if="attrs.startDate" class="nav-link position-relative" :class="{active:page===4}" @click="page=4">
                        <ic_timer></ic_timer>
                        مدت زمان
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
                <div ref="elTime" v-show="page===4">
                    <OrderTime v-if="attrs.startDate" :project="project" :attrs="attrs"></OrderTime>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import tools from "@/Utils/tools";

import Ic_list_2 from "@/Components/svgs/ic_list_2.vue";
import Ic_tag from "@/Components/svgs/ic_tag.vue";
import {ref, watch} from "vue";
import Ic_document_text from "@/Components/svgs/ic_document_text.vue";
import Ic_edit from "@/Components/svgs/ic_edit.vue";
import OrderAttrs from "@/Pages/Admin/Order/OrderAttrs.vue";
import OrderInvoices from "@/Pages/Admin/Order/OrderInvoices.vue";
import OrderSettings from "@/Pages/Admin/Order/OrderSettings.vue";
import OrderDescription from "@/Pages/Admin/Order/OrderDescription.vue";
import Ic_timer from "@/Components/svgs/ic_timer.vue";
import OrderTime from "@/Pages/Admin/Order/OrderTime.vue";
import Ic_settings from "@/Components/svgs/ic_settings.vue";

const page = ref(0);
const separate = (price) => {
    return tools.separate(price);
}
const prop = defineProps({
    project: Object,
    attrs: Object,
    dont_pay: Number
})

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
