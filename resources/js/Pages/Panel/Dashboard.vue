<template>
    <PanelLayout>
        <div class="content__card">
            <div v-if="!user.email" class="welcome-message">
                <div class="welcome-message__text">
                    <img src="/images/icons/celebration.svg" alt="" />
                    <span>{{user.name}}</span>
                    به پشتیبانی سایت خوش آمدید
                </div>
                <div class="welcome-message__notification">
                    <img src="/images/icons/Security-check-user.svg" alt="تایید هویت" />
                    لطفا هویت
                    <span> <Link :href="route('profile.edit')"> حساب کاربری </Link> </span>
                    خود را تایید نمایید
                </div>
            </div>
            <div v-if="pay" class="welcome-message" style="background: #ffdede;">
                <div class="welcome-message__text">
                    <ic_tag></ic_tag>
                    صورت حساب پرداخت نشده ای دارید!
                </div>
                <div class="welcome-message__notification">
                    <span> <Link :href="route('order',{code:pay.code})"> مشاهده و پرداخت </Link> </span>
                </div>
            </div>
            <div class="row gy-4">
                <div class="col-md-12 col-lg-4">
                    <div class="widget">
                        <Link :href="route('service')">
                            <ic_list></ic_list>
                            ثبت سفارش
                        </Link>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="widget">
                        <Link :href="route('orders.list')">
                            <ic_list_search></ic_list_search>
                            پیگیری سفارش
                        </Link>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="widget">
                        <Link :href="route('ticket.list')">
                            <ic_chats></ic_chats>
                            پشتیبانی
                        </Link>
                    </div>
                </div>
            </div>
        </div>
        <div class="content__card">
            <div class="content__card__head">
                <h2 class="content__card__head__title">آخرین سفارشات</h2>
            </div>
            <div class="content__card__body">

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active"  id="all" role="tabpanel"  aria-labelledby="all-tab">
                        <div v-if="projects.length>0" class="table-container">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">شماره سفارش</th>
                                        <th scope="col">تاریخ ثبت</th>
                                        <th scope="col">نوع خدمات</th>
                                        <th scope="col">مبلغ</th>
                                        <th scope="col">وضعیت</th>
                                        <th scope="col">جزییات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="v in projects">
                                        <td data-label="شماره سفارش">#{{ v.code }}</td>
                                        <td data-label="تاریخ ثبت" class="ltr">{{ v.created_at }}</td>
                                        <td data-label="نوع خدمات">{{v.service.name}}</td>
                                        <td data-label="مبلغ" v-if="v.fee!==0">{{ separate(v.fee) }} تومان</td>
                                        <td data-label="مبلغ" v-else>درحال برسی</td>
                                        <td data-label="وضعیت" >
                                            <span
                                                :class="{'c-gold':v.status===0,'c-red':v.status===1,'c-green':(v.status===2||v.status===3||v.status===5||v.status===4),'s-finish':v.status===5,'s-cancel':v.status===-1}">
                                                {{ v.status_fa }}
                                            </span>
                                        </td>
                                        <td data-label="جزییات">
                                            <Link :href="route('order',{code:v.code})">مشاهده</Link>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div v-else class="text-center ">
                            <div class="mb-3">هنوز سفارشی ندارید</div>
                            <Link :href="route('service')" class="d-flex justify-content-center align-items-center">
                                ثبت سفارش
                                <img src="/images/icons/add-square.svg" class="me-1">
                            </Link>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="completed"  role="tabpanel"  aria-labelledby="completed-tab" > تکمیل شده </div>
                    <div class="tab-pane fade" id="canceled"   role="tabpanel"  aria-labelledby="canceled-tab" > لغو شده </div>
                </div>

            </div>
        </div>
    </PanelLayout>
</template>

<script setup>
import Ic_list from "../../Components/svgs/ic_list.vue";
import Ic_list_search from "../../Components/svgs/ic_list_search.vue";
import Ic_chats from "../../Components/svgs/ic_chats.vue";
import PanelLayout from "@/Layouts/PanelLayout.vue";
import {usePage,Link} from "@inertiajs/inertia-vue3";
import Ic_tag from "@/Components/svgs/ic_tag.vue";
import tools from "@/Utils/tools";

const user = usePage().props.value.auth.user;

const prop = defineProps({
    projects: Object,
    pay: Boolean,
});
const separate = (price) => {
    return tools.separate(price);
}
</script>
