<template>
    <AdminLayout>
        <div class="content__card">
            <div class="row gy-4">
                <div class="col-md-6 col-lg-3">
                    <div class="widget">
                        <Link :href="route('admin.users')">
                            <ic_list></ic_list>
                            کاربران
                        </Link>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="widget">
                        <Link :href="route('admin.services')">
                            <ic_list_search></ic_list_search>
                            سرویس ها
                        </Link>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="widget">
                        <Link :href="route('admin.orders')">
                            <ic_chats></ic_chats>
                            پیگیری سفارشات
                        </Link>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="widget">
                        <Link :href="route('admin.tickets')">
                            <ic_chats></ic_chats>
                            پشتیبانی
                        </Link>
                    </div>
                </div>
            </div>
        </div>
        <div class="content__card">
            <div class="content__card__head">
                <h2 class="content__card__head__title"> جدیدترین سفارشات</h2>
                <Link :href="route('admin.orders')" class="btn btn--outline-primary">
                    مشاهده همه
                </Link>
            </div>
            <div class="content__card__body">

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
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
                                        <td v-if="v.fee!==0">{{ separate(v.fee) }} تومان</td>
                                        <td v-else>درحال برسی</td>
                                        <td data-label="وضعیت"  :class="{'c-gold':v.status===0,'c-red':v.status===1||v.status===3||v.status===5,'c-green':v.status===2,'s-finish':v.status===4,}">{{ v.status_fa }}</td>
                                        <td data-label="جزییات">
                                            <Link :href="route('admin.order',{code:v.code})">مشاهده</Link>
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
                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab"> تکمیل
                        شده
                    </div>
                    <div class="tab-pane fade" id="canceled" role="tabpanel" aria-labelledby="canceled-tab"> لغو شده
                    </div>
                </div>

            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import Ic_list from "../../Components/svgs/ic_list.vue";
import Ic_list_search from "../../Components/svgs/ic_list_search.vue";
import Ic_chats from "../../Components/svgs/ic_chats.vue";
import {usePage, Link} from "@inertiajs/inertia-vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import tools from "@/Utils/tools";

const user = usePage().props.value.auth.user;

const prop = defineProps({
    projects: Object,
});
const separate = (price) => {
    return tools.separate(price);
}
</script>

<style scoped>

</style>
