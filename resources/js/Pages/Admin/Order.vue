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
                    <a href="#" class="btn btn--outline-primary">
                        ویرایش صورتحساب
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
                                <strong>{{ project.user.name }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order-detail__item">
                      <span>
                        <img src="/images/icons/order-list.svg" alt="">
                        شماره سفارش:
                      </span>
                                <strong>#{{ project.code }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order-detail__item">
                      <span>
                        <img src="/images/icons/calendar.svg" alt="">
                        تاریخ سفارش:
                      </span>
                                <strong>{{ project.created_at }}</strong>
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
                        <div class="col-lg-4">
                            <div class="order-detail__item">
                      <span>
                        <img src="/images/icons/setting.svg" alt="">
                        نوع وب سایت :
                      </span>
                                <strong class="order-detail__item">{{ project.attr_new.type.name }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order-detail__item">
                      <span>
                        <img src="/images/icons/timer.svg" alt="">
                        مدت زمان پیاده سازی:
                      </span>
                                <strong> &nbsp; {{ project.days }} روز کاری</strong>
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
                                <strong class="text-yellow">{{ project.status_fa }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order-detail__item">
                                <span>
                                    <img src="/images/icons/wallet-money2.svg" alt="">
                                    مبلغ نهایی:
                                </span>
                                <strong class="text-green"> &nbsp; {{ separate(project.fee) }} تومان </strong>
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
                        <ic_list_2></ic_list_2>
                        مشخصات
                    </button>
                    <button class="nav-link position-relative" :class="{active:page===1}" @click="page=1">
                        <ic_document></ic_document>
                        توضیحات
                    </button>
                    <button class="nav-link position-relative" :class="{active:page===4}" @click="page=4">
                        <ic_tag></ic_tag>
                        پرداخت ها
                    </button>
                    <button class="nav-link position-relative" :class="{active:page===2}" @click="page=2">
                        <ic_check_square></ic_check_square>
                        تکمیل شده
                    </button>
                    <button class="nav-link position-relative" id="Order-completion-tab" :class="{active:page===3}"
                            @click="page=3">
                        <ic_times_square></ic_times_square>
                        لغو شده
                    </button>
                </div>

                <div v-if="page===0">
                    <div style="margin-top: 25px;margin-right: 12px;font-weight: 500;">مشخصات</div>
                    <div class="attrs">
                        <div class="item">
                            <div class="order-detail__item">
                      <span>
                        <img src="/images/icons/Sitetype.svg" alt="">
                        پیاده سازی با :
                      </span>
                                <strong> &nbsp; {{ project.attr_new.platform.name }} </strong>
                            </div>
                        </div>
                        <div class="item">
                            <div class="order-detail__item">
                                  <span>
                                    <img src="/images/icons/language.svg" alt="">
                                    زبان :
                                  </span>
                                <strong>فارسی</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="page===1">
                    <div style="margin-top: 25px;margin-right: 12px;font-weight: 500;">مشخصات</div>
                    <div class="attrs">
                        <div class="item">
                            <div class="order-detail__item">
                      <span>
                        <img src="/images/icons/Sitetype.svg" alt="">
                        پیاده سازی با :
                      </span>
                                <strong> &nbsp; {{ project.attr_new.platform.name }} </strong>
                            </div>
                        </div>
                        <div class="item">
                            <div class="order-detail__item">
                                  <span>
                                    <img src="/images/icons/language.svg" alt="">
                                    زبان :
                                  </span>
                                <strong>فارسی</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import tools from "@/Utils/tools";

import Ic_list_2 from "@/Components/svgs/ic_list_2.vue";
import Ic_check_square from "@/Components/svgs/ic_check_square.vue";
import Ic_times_square from "@/Components/svgs/ic_times_square.vue";
import Ic_document from "@/Components/svgs/ic_document_text";
import Ic_tag from "@/Components/svgs/ic_tag.vue";
import {ref} from "vue";

const page = ref(0);
const separate = (price) => {
    return tools.separate(price);
}
const prop = defineProps({
    project: Object
})
</script>
