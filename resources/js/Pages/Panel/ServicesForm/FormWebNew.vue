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
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">شماره هماهنگی</label>
                            <div class="input-group">
                                <input type="text" v-model="form.mobile" class="form-control"
                                       placeholder="مثل : 09128503097">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">نوع سایت </label>
                            <SelectInput v-model="form.type" :options="type"></SelectInput>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">طراحی و برنامه نویسی با</label>
                            <SelectInput v-model="form.platform" :options="platform"></SelectInput>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">چند زبانه بودن</label>
                            <SelectInput v-model="form.cLang" :options="langs"></SelectInput>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">نمونه سایت مشابه </label>
                            <div class="input-group">
                                <input type="text" class="form-control" v-model="form.example"
                                       placeholder="نمونه سایت مشابه نزدیک به نیاز شما ">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <label class="form-label">توضیحات تکمیلی</label>
                            <div class="input-group">
                                <textarea maxlength="4000" rows="7" v-model="form.description" class="form-control"
                                          placeholder="توضيحات شما می تواند ترکيبی از : امکانات لازم وب سايت یا نیازهای شما بصورت لیستی و خلاصه + حداکثر زمان شما و ..."></textarea>
                            </div>
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
                                <input @change="form.file = $event.target.files[0]" id="file-upload__input" type="file"
                                       multiple="" hidden="">
                                <span class="file-upload__names"> </span>
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

const prop = defineProps({
    service: Object,
    type: Object,
    platform: Object,
})
const langs = {
    1: 'تک زبانه',
    2: 'دو زبانه',
    3: 'سه زبانه',
    4: 'چهار زبانه',
}

const form = useForm({
    service: prop.service.id,
    name: null,
    mobile: null,
    type: null,
    platform: null,
    cLang: 1,
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

</script>

