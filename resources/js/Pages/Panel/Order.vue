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
                    <div class="icons" v-if="project.service.id===1">
                        <img v-for="v in project.attr_new.platform.icons" :src="'/images/icons/platform/'+v+'.svg'"/>
                    </div>
                </div>
                <div style="position: relative;z-index: 2" class="order-detail">
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
                                    مدت زمان پیاده سازی
                                  </span>
                                <strong v-if="project.status!==0"> &nbsp; {{ project.days }} روز کاری</strong>
                                <strong v-else class="c-gold"> &nbsp; درحال برسی </strong>
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
                                <strong :class="{'c-gold':project.status===0,'c-red':project.status===1,'c-green':(project.status===2||project.status===3||project.status===5||project.status===4),'s-finish':project.status===5,'s-cancel':project.status===-1}">
                                    &nbsp;{{ project.status_fa }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order-detail__item">
                                <span v-if="project.status===0">
                                    <img src="/images/icons/wallet-money-primary.svg" alt="">
                                    مبلغ اولیه:
                                </span>
                                <span v-else>
                                    <img src="/images/icons/wallet-money-primary.svg" alt="">
                                    پرداخت نشده :
                                </span>
                                <strong v-if="project.paid!==0 && project.status===0" class="text-green"> &nbsp; {{ separate(project.paid) }} تومان </strong>
                                <strong v-else-if="project.status===0"> &nbsp; بدون پرداخت</strong>
                                <strong v-else-if="project.status!==0 && project.fee-project.paid!==0 " class="text-green"> &nbsp; {{ separate(project.fee-project.paid) }} تومان </strong>
                                <strong class="text-green" v-else-if="project.status!==0"> &nbsp;کامل پرداخت شده </strong>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order-detail__item">
                                <span>
                                    <img src="/images/icons/wallet-money2.svg" alt="">
                                    <span v-if="project.status===0 && project.service.form!==3">مبلغ اولیه:</span>
                                    <span v-else>مبلغ کل سفارش:</span>
                                </span>
                                <strong v-if="project.fee!==0 && project.status!==0" class="text-green"> &nbsp; {{ separate(project.fee) }} تومان </strong>
                                <strong v-else class="c-gold"> &nbsp; درحال برسی </strong>
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
                    <p v-if="runningError" style="color: red;">
                        <ic_info class="me-2 ms-1" style="width: 17px;"></ic_info>
                        {{runningError}}
                    </p>
                    <p v-if="project.status===0 && project.service.form!==3">
                        <ic_info class="me-2 ms-1" style="width: 17px;color: #727272;"></ic_info>
                        ما در حال برسی هستیم. زمان پیاده سازی و مبلغ نهایی پس از برسی اعلام میشود!
                    </p>

                </div>
                <Route v-if="project.status>0" :page="page" :step="project.status"></Route>

                <div v-if="page===0">
                    <OrderDescription :attrs="attrs" :project="project"></OrderDescription>
                </div>

                <div v-if="page===1 || page===2">
                    <OrderAttrs :attrs="attrs" :project="project"></OrderAttrs>
                    <div class="infos">
                        <p v-if="project.status===0">
                            <ic_info class="me-2 ms-1" style="width: 17px;color: #727272;"></ic_info>
                            ویژگی ها , مشخصات پروژه و فعالیت ها در طول فرایند در این قسمت قرار خواهد گرفت.
                        </p>
                    </div>
                </div>

                <OrderWorking :attrs="attrs" :project="project" v-if="page===3"></OrderWorking>
                <OrderDemo :attrs="attrs" :project="project" v-if="page===4"></OrderDemo>
                <OrderFinish :attrs="attrs" :project="project" v-if="page===5"></OrderFinish>
            </div>
        </div>
    </PanelLayout>
</template>

<script setup>
import tools from "@/Utils/tools";

import {onUnmounted, ref} from "vue";
import OrderAttrs from "@/Pages/Panel/Order/OrderStart.vue";
import PanelLayout from "@/Layouts/PanelLayout.vue";
import Ic_info from "@/Components/svgs/ic_info.vue";
import Alert from "@/Components/Alert.vue";
import OrderDescription from "@/Pages/Panel/Order/OrderDescription.vue";
import Route from "@/Components/Orders/Route.vue";
import OrderWorking from "@/Pages/Panel/Order/OrderWorking.vue";
import OrderDemo from "@/Pages/Panel/Order/OrderDemo.vue";
import OrderFinish from "@/Pages/Panel/Order/OrderFinish.vue";

const runningError = ref(null);
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
const page = ref(prop.project.status);
if (prop.invoice_id)
    location.href = route('invoice.pay',{id:prop.invoice_id})

const files = ref(0)


const fun = ()=>{
    files.value = 0
    if (prop.attrs.startAttrs){
        const data = prop.attrs.startAttrs
        for (const i in data) {
            if (data[i].value==null && data[i].description==null)
                files.value++
        }
    }

    let filesError = 0;
    if (prop.attrs.startAttrs){
        const data = prop.attrs.startAttrs
        for (const i in data) {
            if (data[i].value2!=null && data[i].value2!=1)
                filesError++
        }
    }


    if (filesError>0){
        runningError.value = filesError+" مورد از فایل های شما در بخش \"اطلاعات درخواستی\" تایید نشده است لطفا آن ها را اصلاح کنید. "
    }
}
fun()
const timer = setInterval(fun,1000)
onUnmounted(()=>{
    clearInterval(timer)
})
</script>
