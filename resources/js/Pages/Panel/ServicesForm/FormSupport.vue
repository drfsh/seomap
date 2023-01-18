<template>
<PanelLayout>

    <div class="content__card">
        <div class="content__card__head">
            <h2 class="content__card__head__title">سفارش خدمات پشتیبانی</h2>

            <!-- Temporary for demo -->
            <div>
                <a v-for="v in plansa" href="#successModal" data-bs-toggle="modal" role="button" class="btn btn--primary outline mx-1">پلن {{v.name}}</a>
            </div>
            <!-- Temporary for demo -->

        </div>
        <div class="content__card__body">
            <form action="#">
                <div class="row gy-4">
                    <div class="col-lg-6">
                        <label class="form-label">نام سایت</label>
                        <div class="input-group">
                            <input v-model="form.title" type="text" class="form-control" placeholder="سایت خود را جهت دریافت بررسی وارد نمایید">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">نوع پلن خود را انتخاب نمایید</label>
                        <SelectInput :options="plans" v-model="form.plan"></SelectInput>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">دسترسی به سایت</label>
                        <div class="input-group">
                            <img src="/images/icons/user.svg" class="me-2">
                            <input type="text" v-model="form.web_user" style="border-left: 1px solid antiquewhite;margin-left: 11px"  class="form-control" placeholder="user"><br>
                            <img src="/images/icons/eye.svg" alt="">
                            <input type="text" v-model="form.web_pass" class="form-control ms-1" placeholder="password">
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">دسترسی به هاست</label>
                        <div class="input-group">
                            <img src="/images/icons/user.svg" class="me-2">
                            <input type="text" v-model="form.host_user" style="border-left: 1px solid antiquewhite;margin-left: 11px" class="form-control" placeholder="user"><br>
                            <img src="/images/icons/eye.svg" alt="">
                            <input type="text" v-model="form.host_pass" class="form-control ms-1" placeholder="password">
                        </div>

                    </div>

                    <div class="col-lg-12">
                        <label class="form-label">توضیحات لازم رو جهت دریافت پشتیبانی درج نمایید</label>
                        <div class="input-group">
                            <textarea rows="10" v-model="form.description" class="form-control" placeholder="کمی بیشتر در مورد پروژه بنویسید و خروجی کار مورد نظر خود را شرح دهید"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-4 d-flex aling-items-center">
                        <div class="file-upload">
                            <label for="file-upload__input">
                                <img src="/images/icons/export.svg" alt="">
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

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="successModalLabel">پلن یک ماهه</div>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <img src="/images/icons/close-circle.svg" alt="">
                    </button>
                </div>
                <div class="modal-body alert">
                    <p>خدمات پلن یک ماهه به شرح ذیل می باشد</p>
                </div>
            </div>
        </div>
    </div>
</PanelLayout>
</template>

<script setup>

import PanelLayout from "@/Layouts/PanelLayout.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {ref} from "vue";
import SelectInput from "@/Components/SelectInput.vue";
import Ic_user_edit from "@/Components/svgs/ic_user_edit.vue";

const prop = defineProps({
    service: Object,
    plans: Object,
    plansa: Object,
    plan_id: Number,
})
const form = useForm({
    service: prop.service.id,
    plan: prop.plan_id?prop.plan_id:0,
    title: null,
    description: '',
    file: null,
    web_user:null,
    web_pass:null,
    host_user:null,
    host_pass:null,
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
