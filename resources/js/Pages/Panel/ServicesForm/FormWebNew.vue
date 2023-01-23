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
                            <label class="form-label">چند زبانه</label>
                            <SelectInput v-model="langS" :options="lags" :n="true"></SelectInput>
                            <InputError :message="form.errors.lang"></InputError>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">نمونه سایت مشابه </label>
                            <div class="input-group">
                                <input type="text" class="form-control" v-model="form.example"
                                       placeholder="نمونه سایت مشابه نزدیک به نیاز شما ">
                            </div>
                            <InputError :message="form.errors.example"></InputError>
                        </div>

                        <div class="col-12">
                            <label class="form-label">  امکانات سایت <span v-if="form.type==3">فروشگاهی</span> <span style="font-size: 12px;font-weight: 400;">(امکانات مورد نظر خود را انتخاب کنید)</span>
                            </label>
                            <div class="input-group">
                                <div class="pt-4 px-3">
                                    <div class="row">
                                        <div v-if="form.type!=3" v-for="(v,i) in listOther" style="display: flex;align-items: center;"
                                             class="mb-4 col-12 col-md-6 col-xl-3 col-lg-6">
                                            <label class="switch-toggles">
                                                <input type="checkbox" v-model="select[i]"
                                                       @change="changeAttrs($event,i)">
                                                <span class="slider round"></span>
                                            </label>
                                            <div class="me-2 attr-t">{{ v }}</div>
                                        </div>
                                        <div v-else v-for="(v,i) in listShop" style="display: flex;align-items: center;"
                                             class="mb-4 col-12 col-md-6 col-xl-3 col-lg-6">
                                            <label class="switch-toggles">
                                                <input type="checkbox" v-model="select[i]"
                                                       @change="changeAttrs($event,i)">
                                                <span class="slider round"></span>
                                            </label>
                                            <div class="me-2 attr-t">{{ v }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                <span class="file-upload__names">{{ textFile }}</span>
                            </div>
                        </div>
                        <div class="col-lg-8 text-end d-flex flex-wrap justify-content-end gap-3 aling-items-center">
                            <div class="result-text">
                                <img src="/images/icons/wallet-money-primary.svg" alt="">
                                حق کارشناسی و برسی :
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
import {ref, watch} from "vue";

const prop = defineProps({
    service: Object,
    type: Object,
    platform: Object,
    plan: Object,
    plan_id: Number,
})
const lags = ref([
    'فارسی',
    'فارسی, نگلیسی',
    'فارسی, عربی',
    'فارسی, ترکی(ترکیه)',
    'فارسی, انگلیسی, عربی, ترکی',
])
const langS = ref(0);
const attrs = ref([]);
const form = useForm({
    service: prop.service.id,
    plan: prop.plan_id ? prop.plan_id : 1,
    lang: null,
    attrs: [],
    name: null,
    mobile: null,
    type: null,
    platform: null,
    example: null,
    description: '',
    file: null
})
const submit = () => {
    console.log(attrs.value)
    return
    form.lang = lags.value[langS.value];
    form.attrs = attrs.value;
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

// attrs

const select = ref([])

const listOther = ref(
    [
        'طراحی لندیگ صفحه اصلی',
        'صفحه خدمات ما',
        'صفحه درباره ما',
        'صفحه تماس با ما',
        'ایجاد و راه اندازی وبلاگ سایت',
        'صفحه نقشه سایت',
        'صفحه پرسش و پاسخ متداول',
        'صفحه نمایش ویدیو و پادکست',
        'گالری تصاویر و نمونه کار',
        'سیستم ارسال خبرنامه',
        'سیستم نظرسنجی',
        'فرم مشاوره یا غیره',
        'صفحه راهنمای کاربران',
        'صفحه قوانین سایت',
        'صفحه حریم خصوصی',
        'صفحه راهنمای سایت',
        'امکان جستجو در سایت',
        'سیستم بنر تبلیغاتی',
        'بخش اخبار سایت',
        'پیوند های مفید ونسخه چاپی',
        'ایجاد شبکه های اجتماعی',
        'طراحی طرح گرافیکی',
        'مشاوره در انتخاب هاست',
        'مشاوره در انتخاب دامنه',
        'بهینه سازی تصاویر و مدیا سایت',
        'معرفی به موتورهای جستجوگر',
        'بهینه سازی کدها برای گوگل',
        'کانفیگ امنیت سایت',
    ]
)
const listShop = ref(
    [
        'طراحی لندیگ صفحه اصلی',
        'پنل حرفه ای کاربران',
        'صفحه درباره ما و مجموعه',
        'صفحه تماس با ما',
        'صفحه قوانین سایت',
        'صفحه حریم خصوصی',
        'صفحه راهنمای سایت',
        'ابزار چت آنلاین',
        'ایجاد و راه اندازی وبلاگ سایت',
        'صفحه راهنمای خرید کاربران',
        'سیستم ارسال خبرنامه',
        'ایجاد نقشه سایت',
        'ایجاد صفحه پرسش و پاسخ',
        'صفحه فروش محصولات ویژه',
        'ایجاد انواع فرم',
        'سیستم صدور فاکتور چاپ',
        'پنل پیامکی اطلاع رسانی',
        'درگاه های بانکی',
        'اینماد و نمادهای اطمینان',
        'سرویس آنلاین حمل و نقل',
        'سیستم نظر سنجی',
        'ایجاد شبکه های اجتماعی',
        'مشاوره در انتخاب هاست',
        'مشاوره در انتخاب دامنه',
        'بهینه سازی تصاویر و مدیا سایت',
        'معرفی به موتورهای جستجوگر',
        'بهینه سازی کدها برای گوگل',
        'کانفیگ امنیت سایت',
    ]
)

const setupList = () => {
    select.value = []
    attrs.value = []
    let list = form.type==3?listShop.value:listOther.value
    for (const valueKey in list) {
        select.value.push(true)
        attrs.value.push(list[valueKey])
    }
}
setupList()
const changeAttrs = (event, i) => {
    const checked = event.target.checked
    let list = form.type==3?listShop.value:listOther.value
    if (!checked)
        for (let j = 0; j < attrs.value.length; j++) {
            if (attrs.value[j] === list[i])
                attrs.value.splice(j, 1);
        }
    else
        attrs.value.push(list[i])
}
let oldType = form.type
watch(form, (value) => {
    if (value!==oldType){
        oldType = form.type
        setupList()
    }
})

</script>

