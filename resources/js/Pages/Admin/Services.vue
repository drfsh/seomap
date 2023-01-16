<template>
    <AdminLayout>
        <div class="content__card">
            <div class="content__card__head">
                <h2 class="content__card__head__title">سرویس ها</h2>
                <Link :href="route('admin.service.create')" class="btn btn--outline-primary">
                    ایجاد سرویس جدید
                </Link>
            </div>
            <div class="content__card__body">
                <div class="row gy-4">
                    <div v-for="v in services" class="col-md-4 col-lg-4">
                        <div class="demo-all">
                            <img :src="v.image" alt="" style="width: 148px;border-radius: 8px;height: 82px;">
                            <div>
                                <p class="sample-service t-blue">{{v.name}}</p>
                                <p class="info-service">{{v.description}}</p>
                                <Link :href="route('admin.service.edit',{id:v.id})" class="btn btn--outline-primary cart">  ویرایش  </Link>
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
import {Link} from "@inertiajs/inertia-vue3"
const prop = defineProps({
    services:Object
})
</script>