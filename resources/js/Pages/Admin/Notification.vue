<template>
    <AdminLayout>
        <div class="content__card">
            <div class="content__card__head">
                <h2 class="content__card__head__title">
                    <img :src="'/images/icons/notifications/'+notification.icon+'.svg'" alt="">
                    {{notification.title}}
                </h2>
                <div>
                    <Link method="delete" :href="route('admin.notification.delete',{id:notification.id})" class="btn btn--outline-primary ms-2">
                        حذف
                    </Link>
                    <Link :href="route('admin.notification.edit',{id:notification.id})" class="btn btn--outline-primary ms-2">
                        ویرایش
                    </Link>
                    <Link :href="route('admin.notifications')" class="btn btn--outline-primary">
                        بازگشت
                    </Link>
                </div>
            </div>
            <div class="content__card__body">
                <div class="notification__detail">
                    <p>
                        {{notification.body}}
                    </p>
                    <p>
                        <strong>دوست دار شما - {{notification.user}}</strong>
                    </p>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import {Link} from '@inertiajs/inertia-vue3'
import AdminLayout from "@/Layouts/AdminLayout.vue";
const prop = defineProps({
    notification:Object
})
</script>
