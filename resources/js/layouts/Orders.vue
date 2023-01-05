<template>
    <div class="content__card">
        <div class="content__card__head">
            <h2 class="content__card__head__title">پیگیری سفارشات</h2>
        </div>
        <div class="content__card__body tabby">

            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="ainformation-tab" data-bs-toggle="tab" data-bs-target="#information" type="button" role="tab" aria-controls="information" aria-selected="true">
                    <ic_list_2></ic_list_2>
                    مشخصات شما
                </button>
                <button class="nav-link" id="info-expo-tab" data-bs-toggle="tab" data-bs-target="#info-expo" type="button" role="tab" aria-controls="info-expo" aria-selected="false">
                   <ic_check_square></ic_check_square>
                    اطلاعات نمایشگاه
                </button>
                <button class="nav-link" id="Order-completion-tab" data-bs-toggle="tab" data-bs-target="#Order-completion" type="button" role="tab" aria-controls="Order-completion" aria-selected="false">
                    <ic_times_square></ic_times_square>
                    تکمیل سفارش
                </button>
            </div>
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
                    <div class="pagination">
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
</template>

<script>
import Ic_list_2 from "../components/svgs/ic_list_2.vue";
import Ic_check_square from "../components/svgs/ic_check_square.vue";
import Ic_times_square from "../components/svgs/ic_times_square.vue";
export default {
    name: "Orders",
    components: {Ic_times_square, Ic_check_square, Ic_list_2}
}
</script>

<style scoped>

</style>