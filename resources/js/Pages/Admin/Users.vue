<template>
    <AdminLayout>
        <div class="content__card">
            <div class="content__card__head">
                <h2 class="content__card__head__title"> کاربران</h2>
                <Link :href="route('admin.user.create')" class="btn btn--outline-primary">ایجاد کاربر جدید</Link>
            </div>

            <div class="content__card__body">
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">تاریخ عضویت</th>
                                <th scope="col">نام و نام خانوادگی</th>
                                <th scope="col">شماره تلفن</th>
                                <th scope="col">ایمیل</th>
                                <th scope="col">اصلاح</th>
                                <th scope="col">اعمال</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users.data">
                                <td data-label="ID" style="min-width: 0;">#{{ user.code }}</td>
                                <td data-label="تاریخ عضویت">{{ user.created_at }}</td>
                                <td data-label="نام و نام خانوادگی">{{ user.name }}</td>
                                <td data-label="شماره تلفن">{{ user.mobile }}</td>
                                <td data-label="ایمیل">{{ user.email ? user.email : '---' }}</td>
                                <td data-label="اصلاح" class="text-yellow">
                                    <Link :href="route('admin.user.edit',{id:user.id})">ویرایش</Link>
                                </td>
                                <td data-label="اعمال">
                                    <a role="button"  @click="destroy(user.id)">حذف</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

                <!-- Pagination - START -->
                <Paginate :data="users"></Paginate>
                <!-- Pagination - END -->

            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import {Link, useForm} from "@inertiajs/inertia-vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Paginate from "@/Components/Paginate.vue";
const prop = defineProps({
    users: Object,
});

const destroy = (id) => {
    if (confirm('ایا از حذف کاربر مطمعن هستید؟')){
        useForm({}).delete(route('admin.user.delete',{id:id}))
    }
}
</script>

<style scoped>

</style>
