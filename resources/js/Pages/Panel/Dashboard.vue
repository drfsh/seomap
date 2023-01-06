<template>
    <PanelLayout>
        <div class="content__card">
            <div class="welcome-message">
                <div class="welcome-message__text">
                    <img src="/images/icons/celebration.svg" alt="" />
                    <span>کاربر جدید سایت </span>
                    به پشتیبانی سایت خوش آمدید
                </div>
                <div class="welcome-message__notification">
                    <img src="/images/icons/Security-check-user.svg" alt="تایید هویت" />
                    لطفا هویت
                    <span> <a href="profile.html"> حساب کاربری </a> </span>
                    خود را تایید نمایید
                </div>
            </div>
            <div class="row gy-4">
                <div class="col-md-12 col-lg-4">
                    <div class="widget">
                        <a href="orders-new-expo.html">
                            <ic_list></ic_list>
                            ثبت سفارش
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="widget">
                        <a href="favorite.html">
                            <ic_list_search></ic_list_search>
                            پیگیری سفارش
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="widget">
                        <a href="orders-expo.html">
                            <ic_chats></ic_chats>
                            پشتیبانی
                        </a>
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
                                        <th scope="col">نام نمایشگاه </th>
                                        <th scope="col">مبلغ</th>
                                        <th scope="col">وضعیت</th>
                                        <th scope="col">جزییات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>#507285</td>
                                        <td>1401/01/15</td>
                                        <td>نمایشگاه  شماره یک</td>
                                        <td>110,400 تومان</td>
                                        <td class="text-yellow">پیش نویس</td>
                                        <td>
                                            <a href="orders-detail-expo.html">مشاهده</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#817285</td>
                                        <td>1401/02/06</td>
                                        <td>نمایشگاه  شماره دو</td>
                                        <td>110,400 تومان</td>
                                        <td class="text-green">تکمیل شده</td>
                                        <td>
                                            <a href="orders-detail-expo.html">مشاهده</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#619285</td>
                                        <td>1401/03/27</td>
                                        <td>نمایشگاه  شماره سه</td>
                                        <td>110,400 تومان</td>
                                        <td class="text-red">لغو شده</td>
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
</script>

<style scoped>

</style>
