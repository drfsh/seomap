<template>
    <PanelLayout>
        <Alert :message="session"></Alert>
        <div class="content__card">
            <div class="content__card__head">
                <h2 class="content__card__head__title">
                    جزییات سفارش مشتری
                </h2>
                <div>

                    <a v-if="dont_pay>0"
                       :href="route('invoice.pay',{id:pay})"
                       class="btn btn--primary ms-2">
                         پرداخت صورت حساب جاری
                    </a>
                    <a v-if="project.ticket" target="_blank" :href="route('ticket.view',{code:project.ticket.code})"
                       class="btn btn--outline-primary ms-2">
                        تیکت
                    </a>
                    <a v-else target="_blank" :href="route('ticket.create',{project:project.id})"
                       class="btn btn--outline-primary ms-2">
                        ایجاد تیکت
                    </a>
                </div>
            </div>

            <div class="content__card__body tabby">

                <div class="plan-" :class="{'h':project.plan.id===2,'v':project.plan.id===3,'e':project.plan.id===4}">
                    {{ project.plan.name }}
                </div>

                <div class="order-detail">
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
                                <strong class="ltr">&nbsp;{{ project.created_at }}&nbsp;&nbsp;</strong>
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
                                <strong :class="{'c-gold':project.status===0,'c-red':project.status===1||project.status===3||project.status===5,'c-green':project.status===2,'s-finish':project.status===4,}">
                                    &nbsp;{{ project.status_fa }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order-detail__item">
                                <span>
                                    <img src="/images/icons/wallet-money2.svg" alt="">
                                    <span v-if="project.status===0 && project.service.form!==3">مبلغ اولیه:</span>
                                    <span v-else>مبلغ نهایی:</span>
                                </span>
                                <strong v-if="project.fee!==0" class="text-green"> &nbsp; {{ separate(project.fee) }} تومان </strong>
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
                <div class="infos">
                    <p v-if="dont_pay>0" style="color: red;">
                        <ic_info class="me-2 ms-1" style="width: 17px;"></ic_info>
                        شما <span style="font-weight: 600;margin: 0 4px;">{{dont_pay}}</span> صورتحساب پرداخت نشده دارید!
                        .&nbsp;
                        جهت پرداخت در بخش صورت حساب ها اقدام نمایید.
                    </p>
                    <p v-if="project.status===0 && project.service.form!==3">
                        <ic_info class="me-2 ms-1" style="width: 17px;color: #727272;"></ic_info>
                        زمان پیاده سازی و مبلغ نهایی پس از برسی اعلام میشود!
                    </p>
                </div>
                <div class="nav nav-tabs mt-3" id="nav-tab" role="tablist">
                    <button class="nav-link position-relative" :class="{active:page===0}" @click="page=0">
                        <ic_document_text></ic_document_text>
                        توضیحات
                    </button>
                    <button class="nav-link position-relative" :class="{active:page===1}" @click="page=1">
                        <ic_list_2></ic_list_2>
                        مشخصات
                        <span v-if="attrs.processing" class="count bg-blue" style="width: 10px;height: 10px;animation: pulse-primary 2s infinite;"></span>
                    </button>
                    <button class="nav-link position-relative" :class="{active:page===2}" @click="page=2">
                        <ic_tag></ic_tag>
                        صورتحساب ها
                        <span  v-if="dont_pay!==0" class="count bg-blue" style="animation: pulse-primary 2s infinite;">{{dont_pay}}</span>
                    </button>
                </div>

                <div v-if="page===0">
                    <div v-if="project.file">
                        <div class="min-title">فایل پیوست</div>
                        <div class="order-detail mt-3">
                            <a target="_blank" :href="project.file" class="order-info">
                                بازکردن فایل
                            </a>
                        </div>
                    </div>  <div>
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
                </div>

                <div v-if="page===1">
                    <OrderAttrs :attrs="attrs" :project="project"></OrderAttrs>
                    <div class="infos">
                        <p v-if="project.status===0">
                            <ic_info class="me-2 ms-1" style="width: 17px;color: #727272;"></ic_info>
                            ویژگی ها , مشخصات پروژه و فعالیت ها در طول فرایند در این قسمت قرار خواهد گرفت.
                        </p>
                    </div>
                </div>

                <div v-if="page===2">
                    <OrderInvoices :invoices="project.invoices"></OrderInvoices>
                </div>
            </div>
        </div>
    </PanelLayout>
</template>

<script setup>
import tools from "@/Utils/tools";

import Ic_list_2 from "@/Components/svgs/ic_list_2.vue";
import Ic_tag from "@/Components/svgs/ic_tag.vue";
import {ref} from "vue";
import Ic_document_text from "@/Components/svgs/ic_document_text.vue";
import OrderAttrs from "@/Pages/Panel/Order/OrderAttrs.vue";
import OrderInvoices from "@/Pages/Panel/Order/OrderInvoices.vue";
import PanelLayout from "@/Layouts/PanelLayout.vue";
import Ic_info from "@/Components/svgs/ic_info.vue";
import Alert from "@/Components/Alert.vue";

const page = ref(0);
const separate = (price) => {
    return tools.separate(price);
}
const prop = defineProps({
    project: Object,
    attrs: Object,
    pay:Number,
    dont_pay:Number,
    session:String,
    invoice_id:Number
})

if (prop.invoice_id)
    location.href = route('invoice.pay',{id:prop.invoice_id})

</script>
