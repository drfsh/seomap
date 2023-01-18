<template>
    <div class="min-title">ایجاد صورتحساب</div>
    <form class="mt-4 p-2 mb-2" @submit.prevent="submit">
        <div class="row gy-4">

            <div class="col-md-6 col-lg-6">
                <div class="input-group">
                    <input type="text" v-model="form.info" class="form-control"
                           placeholder="توضیحات">
                </div>
                <InputError class="mt-2" :message="form.errors.info"/>

            </div>

            <div class="col-md-6 col-lg-4">
                <div class="input-group">
                    <input type="number" v-model="form.amount" class="form-control"
                           placeholder="مبلغ (تومان)">
                    <span class="input-group-text">
                    </span>
                </div>
                <div v-if="form.amount" class="text-start c-green" style="font-size: 13px;margin: 6px;font-weight: 600;">{{separate(form.amount)}} تومان</div>
                <InputError class="mt-2" :message="form.errors.amount"/>
            </div>
            <div class="col-md-2 text-center align-self-start">
                <button :disabled="form.processing" type="submit"
                        class="btn btn--primary outline">
                    <span v-if="!form.processing">ثبت</span>
                    <Loading v-else color="#2f5bea"></Loading>
                </button>
            </div>
        </div>
    </form>
    <hr>
    <div v-if="invoices.length>0" class="table-container mt-3">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">شماره پیگیری</th>
                    <th scope="col">مقدار</th>
                    <th scope="col">ضعیت</th>
                    <th scope="col">توضیحات</th>
                    <th scope="col">تاریخ</th>
                    <th scope="col">پرداخت</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="v in invoices">
                    <td>#{{ v.code }}</td>
                    <td>{{ separate(v.amount) }} تومان </td>
                    <td style="font-weight: 600" :class="{'c-green':v.status===1,'c-red':v.status===2,'c-gold':v.status===0}">{{ v.status_fa }}</td>
                    <td>{{ v.info }}</td>
                    <td class="ltr">{{ v.created_at }}</td>
                    <td class="ltr" >{{ v.pay_date?v.pay_date:'----' }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div v-else class="text-center mt-5">
        <div class="mb-3">پرداختی صورت نگرفته</div>
    </div>
</template>

<script setup>
import tools from "@/Utils/tools.js";
import {useForm} from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import Loading from "@/Components/Loading.vue";

const prop = defineProps(['invoices','project'])
const separate = (price) => {
    return tools.separate(price);
}

const form = useForm({
    info: null,
    amount: null,
    project:prop.project.id
});

const submit = () => {
    form.post(route('admin.invoice.store'));
};
const status = [
    'درحال برسی',
    'در انتضار پرداخت',
    'درحال انجام',
    'درانتضار پرداخت نهایی',
    'اتمام',
    'لغو'
]
</script>
