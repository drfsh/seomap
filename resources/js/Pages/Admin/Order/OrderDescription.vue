<template>


    <div class="plan- mt-4" :class="{'h':project.plan.id===2,'v':project.plan.id===3,'e':project.plan.id===4}">
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

    <div class="row">
        <div class="col-md-6" v-if="attrs.lang">
            <div class="min-title">زبان محتوا</div>
            <div class="order-detail mt-3">
                <p class="order-info">
                    {{ attrs.lang[0].description }}
                </p>
            </div>
        </div>
        <div class="col-md-6" v-if="project.attr_new && project.attr_new.example">
            <div class="min-title" v-if="project.service_id==1">نمونه سایت مشابه</div>
            <div class="order-detail mt-3">
                <p class="order-info ltr">
                    {{ project.attr_new.example }}
                </p>
            </div>
        </div>
        <div v-if="project.access">
            <div class="min-title">دسترسی ها</div>
            <div class="order-detail mt-3">
                <div style="height: 24px;">
                    هاست :
                    <span style="border-radius: 11px;padding: 0 9px;" class="order-info float-start bg-blue">
                                 username:   {{ project.access.host_username }}
                            </span>
                    <span style="border-radius: 11px;padding: 0 9px;" class="order-info float-start bg-blue ms-2">
                                 password:   {{ project.access.host_password }}
                            </span>
                </div>
            </div>    <div class="order-detail mt-3">
            <div style="height: 24px;">
                سایت :
                <span style="border-radius: 11px;padding: 0 9px;" class="order-info float-start bg-blue">
                                 username:   {{ project.access.web_username }}
                            </span>
                <span style="border-radius: 11px;padding: 0 9px;" class="order-info float-start bg-blue ms-2">
                                 password:   {{ project.access.web_password }}
                            </span>
            </div>
        </div>
        </div>
        <div v-if="project.file">
            <div class="min-title">فایل پیوست</div>
            <div class="order-detail mt-3">
                <a target="_blank" :href="project.file" class="order-info">
                    بازکردن فایل
                </a>
            </div>
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
            <div class="row mt-4 px-2 order-detail">
                <div v-for="v in attrs.attr" class="mb-4 col-12 col-md-6 col-xl-3 col-lg-6">
                    <ic_tick_blue></ic_tick_blue>
                    <strong style="font-size: 13px"> &nbsp; {{ v.description }} </strong>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Ic_tick_blue from "@/Components/svgs/ic_tick_blue.vue";
import tools from "@/Utils/tools.js";

defineProps(['project','attrs'])

const separate = (price) => {
    return tools.separate(price);
}
</script>
