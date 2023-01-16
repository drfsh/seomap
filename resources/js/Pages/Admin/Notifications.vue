<template>
    <AdminLayout>
        <div class="content__card">
        <div class="content__card__head">
            <h2 class="content__card__head__title">اعلان ها</h2>
            <Link :href="route('admin.notification.create')" class="btn btn--outline-primary">
                ایجاد اعلان جدید
            </Link>
        </div>
        <div class="content__card__body">
            <div v-for="v in notifications.data" class="notification">
                <div class="notification__body">
                    <p v-html="v.body"></p>
                </div>
                <hr>
                <div class="notification__footer">
                    <div class="notification__footer__meta">
                        <div class="notification__footer__meta__item">
                            <img :src="'/images/icons/notifications/'+v.icon+'.svg'" alt="">
                            {{v.title}}
                        </div>
                        <div class="notification__footer__meta__item">
                            <img src="/images/icons/calendar.svg" alt="">
                            {{v.created_at}}
                        </div>
                        <div class="notification__footer__meta__item">
                            <img src="/images/icons/message-tick.svg" alt="">
                            وضعیت :
                            <span class="text-green">دیده شده</span>
                        </div>
                    </div>
                    <Link class="notification__footer__link" :href="route('admin.notification',{id:v.id})">
                        مشاهده کامل اعلان
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.24988 12.9399L1.35988 8.04987C0.782383 7.47237 0.782383 6.52738 1.35988 5.94988L6.24988 1.05988" stroke="#04102B" stroke-width="1.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </Link>
                </div>
            </div>
            <div v-if="notifications.data.length==0" class="text-center ">
                <div class="mb-3">هنوز اعلانی ایجاد نشده است</div>
            </div>

            <Paginate :data="notifications"></Paginate>
        </div>
    </div>
    </AdminLayout>
</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3"
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Paginate from "@/Components/Paginate.vue";
const prop = defineProps({
    notifications:Object
})

</script>

<style scoped>

</style>
