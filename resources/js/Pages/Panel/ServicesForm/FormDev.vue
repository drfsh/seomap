<template>
<PanelLayout>
    <div class="content__card">
        <div class="content__card__head">
            <h2 class="content__card__head__title">سفارش ثبت سفارش</h2>
        </div>
        <div class="content__card__body">
            <form action="#">
                <div class="row gy-4">
                    <div class="col-lg-6">
                        <label class="form-label">نوع خدمات</label>
                        <div class="input-group" style="padding: 14px;">
                            <span>{{services[form.service]}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">نام سایت</label>
                        <div class="input-group">
                            <input type="text" v-model="form.title" class="form-control" placeholder="نام سایت خود را وارد نمایید">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <label class="form-label">بیشتر درباره پروژه بگویید</label>
                        <div class="input-group">
                            <textarea v-model="form.description" rows="10" class="form-control" placeholder="کمی بیشتر در مورد پروژه بنویسید و خروجی کار مورد نظر خود را شرح دهید"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-4 d-flex aling-items-center">
                        <div class="file-upload">
                            <label for="file-upload__input">
                                <img src="assets/images/icons/export.svg" alt="">
                                فایلهای خود را آپلود کنید
                            </label>
                            <input @change="selectFile" id="file-upload__input" type="file" multiple="" hidden="">
                            <span class="file-upload__names">{{textFile}}</span>
                        </div>
                    </div>
                    <div class="col-lg-8 text-end d-flex flex-wrap justify-content-end gap-3 aling-items-center">
                        <a @click="submit" data-bs-toggle="modal" role="button" class="btn btn--primary"> ارسال جهت بررسی </a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</PanelLayout>
</template>

<script setup>
import PanelLayout from "@/Layouts/PanelLayout.vue";
import SelectInput from "@/Components/SelectInput.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";

const prop = defineProps({
    service: Object,
    services: Object,
    plan_id: Number,
})
const form = useForm({
    service: prop.service.id,
    plan: prop.plan_id?prop.plan_id:1,
    title: null,
    description: '',
    file: null
})
const submit = () => {
    form.post(route('orders.store'), {
        forceFormData: true,
    })
}
const textFile = ref(null)
const selectFile = (event) => {
    if (event.target.files && event.target.files[0]) {
        const file = event.target.files[0];
        form.file = file
        textFile.value = file.name
    }
}
</script>

