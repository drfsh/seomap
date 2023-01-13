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
                        <Link :href="route('orders.view')">
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
                        <div class="table-container">
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
                                        <td>#{{ v.code }}</td>
                                        <td class="ltr">{{v.created_at}}</td>
                                        <td>{{v.title}}</td>
                                        <td>{{v.fee}} تومان</td>
                                        <td class="text-yellow">{{v.status_fa}}</td>
                                        <td>
                                            <a href="orders-detail-expo.html">مشاهده</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Pagination - START -->
                        <div v-if="false" class="pagination">
                            <div class="page-item">
                                <a href="#" class="page-link previous">
                                    <img src="/images/icons/chevron.svg" alt="" />
                                </a>
                            </div>
                            <div class="page-item">
                                <a href="#" class="page-link">1</a>
                            </div>
                            <div class="page-item">
                                <a href="#" class="page-link">2</a>
                            </div>
                            <div class="page-item active">
                                <a href="#" class="page-link">3</a>
                            </div>
                            <span>...</span>
                            <div class="page-item">
                                <a href="#" class="page-link">4</a>
                            </div>
                            <div class="page-item">
                                <a href="#" class="page-link next">
                                    <img src="/images/icons/chevron.svg" alt="" />
                                </a>
                            </div>
                        </div>
                        <!-- Pagination - END -->
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

const user = usePage().props.value.auth.user;

const prop = defineProps({
    projects: Object,
});

console.log(prop.projects)
</script>

<style scoped>

</style>
