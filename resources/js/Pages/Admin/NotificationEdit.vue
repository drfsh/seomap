<template>
<AdminLayout>
    <div class="content__card">
        <div class="content__card__head">
            <h2 class="content__card__head__title">ویرایش اعلان
            </h2>
            <Link :href="route('admin.notification',{id:notification.id})" class="btn btn--outline-primary">
                بازگشت
            </Link>
        </div>



        <div class="content__card__body">
            <form @submit.prevent="submit">
                <div class="row gy-4">
                    <div class="col-lg-6">
                        <label class="form-label"> عنوان</label>
                        <div class="input-group">
                            <input v-model="form.title" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">ایکن </label>
                        <div class="input-group">
                            <input type="text" v-model="form.icon" placeholder="مثال :‌telegram" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-label">محتوای اعلان</label>
                        <div class="input-group">
                            <textarea v-model="form.body" type="text" rows="8" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12 text-end align-self-end">
                        <button type="submit" class="btn btn--primary outline">
                            ثبت اعلان
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</AdminLayout>
</template>

<script setup>
import {Link, useForm} from '@inertiajs/inertia-vue3'
import AdminLayout from "@/Layouts/AdminLayout.vue";

const prop = defineProps({
    notification:Object
})
const form = useForm({
    title:prop.notification.title,
    icon:prop.notification.icon,
    body:prop.notification.body,
})
const submit = () => {
    form.post(route('admin.notification.update',{id:prop.notification.id}))
}
</script>

<style scoped>

</style>