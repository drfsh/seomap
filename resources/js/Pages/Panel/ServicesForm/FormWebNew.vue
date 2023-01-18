<template>
    <PanelLayout>
        <div class="content__card">
            <div class="content__card__head">
                <h2 class="content__card__head__title">سفارش طراحی سایت</h2>
            </div>
            <div class="content__card__body">
                <form @submit.prevent="submit">
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <label class="form-label">نام شما / سفارش دهنده / شرکت</label>
                            <div class="input-group">
                                <input type="text" v-model="form.name" class="form-control"
                                       placeholder="مدیر عامل ، مدیرفناوری اطلاعات">
                            </div>
                            <InputError :message="form.errors.name"></InputError>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">شماره هماهنگی</label>
                            <div class="input-group">
                                <input type="number" v-model="form.mobile" class="form-control"
                                       placeholder="مثل : 09128503097">
                            </div>
                            <InputError :message="form.errors.mobile"></InputError>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">پلن</label>
                            <SelectInput v-model="form.plan" :options="plan" :n="true"></SelectInput>
                            <InputError :message="form.errors.plan"></InputError>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">نوع سایت </label>
                            <SelectInput v-model="form.type" :options="type"></SelectInput>
                            <InputError :message="form.errors.type"></InputError>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">طراحی و برنامه نویسی با</label>
                            <SelectInput v-model="form.platform" :options="platform"></SelectInput>
                            <InputError :message="form.errors.platform"></InputError>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">نمونه سایت مشابه </label>
                            <div class="input-group">
                                <input type="text" class="form-control" v-model="form.example"
                                       placeholder="نمونه سایت مشابه نزدیک به نیاز شما ">
                            </div>
                            <InputError :message="form.errors.example"></InputError>
                        </div>

                        <div class="col-lg-12">
                            <label class="form-label">توضیحات تکمیلی</label>
                            <div class="input-group">
                                <textarea maxlength="4000" rows="7" v-model="form.description" class="form-control"
                                          placeholder="توضيحات شما می تواند ترکيبی از : امکانات لازم وب سايت یا نیازهای شما بصورت لیستی و خلاصه + حداکثر زمان شما و ..."></textarea>
                            </div>
                            <InputError :message="form.errors.description"></InputError>
                            <div class="mt-3">
                                <span>{{ form.description.length }}</span>
                                <span>/</span>
                                <span>4,000</span>
                            </div>
                        </div>

                        <div class="col-lg-4 d-flex aling-items-center">
                            <div class="file-upload">
                                <label for="file-upload__input">
                                    <img src="/images/icons/export.svg" alt="">
                                    فایلهای خود را آپلود کنید
                                </label>
                                <input @change="selectFile" id="file-upload__input" type="file"
                                       multiple="" hidden="">
                                <span class="file-upload__names">{{textFile}}</span>
                            </div>
                        </div>
                        <div class="col-lg-8 text-end d-flex flex-wrap justify-content-end gap-3 aling-items-center">
                            <div class="result-text">
                                <img src="/images/icons/wallet-money-primary.svg" alt="">
                                پیش پرداخت اولیه :
                                <span>2.000.000 تومان</span>
                            </div>
                            <button class="btn btn--primary">
                                پرداخت و ثبت سفارش
                            </button>
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
    type: Object,
    platform: Object,
    plan: Object,
    plan_id: Number,
})
const form = useForm({
    service: prop.service.id,
    plan: prop.plan_id?prop.plan_id:1,
    name: null,
    mobile: null,
    type: null,
    platform: null,
    example: null,
    description: '',
    file: null
})
const submit = () => {
    console.log("ok")
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

