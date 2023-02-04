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
                    <a v-if="project.ticket && project.status>1" target="_blank" :href="route('ticket.view',{code:project.ticket.code})"
                       class="btn btn--outline-primary ms-2">
                        تیکت
                    </a>
                    <a v-else-if="project.status>1" target="_blank" :href="route('ticket.create',{project:project.id})"
                       class="btn btn--outline-primary ms-2">
                        ایجاد تیکت
                    </a>
                    <a :href="route('orders.list')"
                       class="btn btn--outline-primary ms-2">
                        بازگشت
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
                                    <span v-else>مبلغ پروژه:</span>
                                </span>
                                <strong v-if="project.fee!==0 && project.status!==0" class="text-green"> &nbsp; {{ separate(project.fee) }} تومان </strong>
                                <strong v-else class="c-gold"> &nbsp; درحال برسی </strong>
                            </div>
                        </div>
                    </div>

                    <div v-if="p!=null && project.status===3" class="p-3 mt-3">
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
import moment from "jalali-moment";

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


const fun1 = ()=>{
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
fun1()
const timer1 = setInterval(fun1,1000)
onUnmounted(()=>{
    clearInterval(timer1)
})

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
if (prop.project.status===3){

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

}
const dataFormat = (date, format) => {
    return moment(date, 'YYYY-MM-DDTH:mm:ss.000000Z').locale('fa').format(format)
}

</script>
