<template>
    <div class="min-title">وضعیت</div>
    <div class="table-container mt-3">
        <div class="attrs justify-content-around">
            <button @click="changeStatus(i)" class="btn btn--primary" :class="{'outline':i!==project.status}" v-for="(v,i) in status">{{v}}</button>
        </div>
    </div>

    <form class="mt-4 p-2 mb-2" @submit.prevent="submit">
        <div class="row gy-4">

            <div class="col-md-6 col-lg-4">
                <label class="form-label">نام پروژه</label>
                <div class="input-group">
                    <input type="text" v-model="form.title" class="form-control"
                           placeholder="پروژه">
                    <span class="input-group-text">
                        <img src="/images/icons/user.svg" alt="">
                    </span>
                </div>
                <InputError class="mt-2" :message="form.errors.title"/>
            </div>

            <div class="col-md-6 col-lg-4">
                <label class="form-label">هزینه</label>
                <div class="input-group">
                    <input type="number" v-model="form.fee" class="form-control"
                           placeholder="تومان">
                    <span class="input-group-text">
<!--                        <img src="/images/icons/user.svg" alt="">-->
                    </span>
                </div>
                <div class="text-start c-green" style="font-size: 13px;margin: 6px;font-weight: 600;">{{separate(form.fee)}} تومان</div>
                <InputError class="mt-2" :message="form.errors.fee"/>
            </div>

            <div class="col-md-6 col-lg-4">
                <label class="form-label">زمان پیاده سازی (روز)</label>
                <div class="input-group">
                    <input type="number" v-model="form.days" class="form-control"
                           placeholder="روز">
                    <span class="input-group-text">
<!--                        <img src="/images/icons/user.svg" alt="">-->
                    </span>
                </div>
                <InputError class="mt-2" :message="form.errors.days"/>
            </div>

            <div class="col-md-12 text-center align-self-start">
                <button :disabled="form.processing" type="submit"
                        class="btn btn--primary outline">
                    <span v-if="!form.processing">بروزرسانی اطلاعات</span>
                    <Loading v-else color="#2f5bea"></Loading>
                </button>
            </div>
        </div>
    </form>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import Loading from "@/Components/Loading.vue";
import tools from "@/Utils/tools.js";

const prop = defineProps(['project'])
const form = useForm({
    title: prop.project.title,
    fee: prop.project.fee,
    days : prop.project.days,
    id : prop.project.id,
});

const submit = () => {
    form.post(route('admin.order.update'));
};
const status = [
    'درحال برسی',
    'در انتضار پرداخت',
    'درحال انجام',
    'درانتضار پرداخت نهایی',
    'اتمام',
    'لغو'
]
const separate = (price) => {
    return tools.separate(price);
}
const changeStatus = async (p) => {
    let {data} = await axios.post(route('admin.order.status'),{id:prop.project.id,status:p})
    prop.project.status = data.data.status
    prop.project.status_fa = data.data.status_fa
}
</script>
