<template>
    <div v-if="invoices.length>0" class="table-container mt-3">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">شماره پیگیری</th>
                    <th scope="col">مقدار</th>
                    <th scope="col">ضعیت</th>
                    <th scope="col">توضیحات</th>
                    <th scope="col">صدور</th>
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
                    <td class="ltr" v-if="v.pay_date && v.status===1">{{ v.pay_date }}</td>
                    <td class="ltr" v-else>
                        <a :href="route('invoice.pay',{id:v.id})">
                            <button type="submit" class="btn btn--primary outline"><span>پرداخت</span></button>
                        </a>
                    </td>
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

const prop = defineProps(['invoices'])
const separate = (price) => {
    return tools.separate(price);
}

const pay = (id)=>{
    useForm({invoice:id}).post(route('invoice.pay'))
}
</script>
