<template>
    <PanelLayout>
        <div class="content__card">
            <div class="content__card__head">
                <h2 class="content__card__head__title">پیگیری سفارشات</h2>
                <form @submit.prevent="search">
                    <div class="input-group">
                        <input v-model="code" type="text" class="form-control" placeholder="کد رهگیریتان را برای پیگیری سفارش وارد کنید">
                        <span class="input-group-text">
                    <img src="/images/icons/keyboard.svg" alt="">
                  </span>
                    </div>
                </form>
            </div>
            <div class="content__card__body tabby">

                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link position-relative" :class="{active:page===0}" @click="page=0">
                        <ic_list_2></ic_list_2>
                        همه سفارشات
                        <span v-if="projects.data.length!==0" class="count">{{projects.data.length}}</span>
                    </button>
                    <button class="nav-link position-relative" :class="{active:page===1}" @click="page=1">
                        <ic_check_square></ic_check_square>
                        تکمیل شده
                        <span v-if="pOk.data.length!==0" class="count">{{pOk.data.length}}</span>
                    </button>
                    <button class="nav-link position-relative" id="Order-completion-tab"  :class="{active:page===2}" @click="page=2">
                        <ic_times_square></ic_times_square>
                        لغو شده
                        <span v-if="pCancel.data.length!==0" class="count">{{pCancel.data.length}}</span>
                    </button>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div v-if="page===0">
                        <div v-if="projects.data.length>0" class="table-container">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">شماره سفارش</th>
                                        <th scope="col">تاریخ ثبت</th>
                                        <th scope="col">نوع خدمات</th>
                                        <th scope="col">مبلغ</th>
                                        <th scope="col">وضعیت</th>
                                        <th scope="col">جزییات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="v in projects.data" >
                                        <td data-label="شماره سفارش">#{{ v.code }}</td>
                                        <td data-label="تاریخ ثبت" class="ltr">{{ v.created_at }}</td>
                                        <td data-label="نوع خدمات">{{v.service.name}}</td>
                                        <td data-label="مبلغ" v-if="v.fee!==0">{{ separate(v.fee) }} تومان</td>
                                        <td data-label="مبلغ" v-else>درحال برسی</td>
                                        <td data-label="وضعیت" >
                                            <span
                                                :class="{'c-gold':v.status===0,'c-red':v.status===1,'c-green':(v.status===2||v.status===3||v.status===5||v.status===4),'s-finish':v.status===5,'s-cancel':v.status===-1}">
                                                {{ v.status_fa }}
                                            </span>
                                        </td>
                                        <td data-label="جزییات">
                                            <Link :href="route('order',{code:v.code})">مشاهده</Link>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div v-else class="text-center ">
                            <div class="mb-3">هنوز سفارشی ندارید</div>
                        </div>
                        <Paginate :data="projects"></Paginate>
                    </div>
                    <div v-if="page===1">

                        <div v-if="pOk.data.length>0" class="table-container">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">شماره سفارش</th>
                                        <th scope="col">تاریخ ثبت</th>
                                        <th scope="col">نوع خدمات</th>
                                        <th scope="col">مبلغ</th>
                                        <th scope="col">وضعیت</th>
                                        <th scope="col">جزییات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="v in pOk.data">
                                        <td>#{{ v.code }}</td>
                                        <td class="ltr">{{ v.created_at }}</td>
                                        <td>{{v.service.name}}</td>
                                        <td>{{ separate(v.fee) }} تومان</td>
                                        <td :class="{'c-gold':v.status===0,'c-red':v.status===1||v.status===3||v.status===5,'c-green':v.status===2,'s-finish':v.status===4,}">{{ v.status_fa }}</td>
                                        <td>
                                            <Link :href="route('admin.order',{code:v.code})">مشاهده</Link>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div v-else class="text-center ">
                            <div class="mb-3">هنوز سفارشی ندارید</div>
                        </div>
                        <Paginate :data="pOk"></Paginate>
                    </div>
                    <div v-if="page===2">

                        <div v-if="pCancel.data.length>0" class="table-container">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">شماره سفارش</th>
                                        <th scope="col">تاریخ ثبت</th>
                                        <th scope="col">نوع خدمات</th>
                                        <th scope="col">مبلغ</th>
                                        <th scope="col">وضعیت</th>
                                        <th scope="col">جزییات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="v in pCancel.data">
                                        <td>#{{ v.code }}</td>
                                        <td class="ltr">{{ v.created_at }}</td>
                                        <td>{{v.service.name}}</td>
                                        <td>{{ separate(v.fee) }} تومان</td>
                                        <td :class="{'c-gold':v.status===0,'c-red':v.status===1||v.status===3||v.status===5,'c-green':v.status===2,'s-finish':v.status===4,}">{{ v.status_fa }}</td>
                                        <td>
                                            <Link :href="route('admin.order',{code:v.code})">مشاهده</Link>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div v-else class="text-center ">
                            <div class="mb-3">هنوز سفارشی ندارید</div>
                        </div>
                        <Paginate :data="pCancel"></Paginate>
                    </div>
                </div>

            </div>
        </div>
    </PanelLayout>
</template>

<script setup>

import Ic_list_2 from "@/Components/svgs/ic_list_2.vue";
import Ic_check_square from "@/Components/svgs/ic_check_square.vue";
import Ic_times_square from "@/Components/svgs/ic_times_square.vue";
import Paginate from "@/Components/Paginate.vue";
import {ref} from "vue";
import {useForm,Link} from "@inertiajs/inertia-vue3";
import tools from "@/Utils/tools.js";
import PanelLayout from "@/Layouts/PanelLayout.vue";

const page = ref(0)
const prop = defineProps({
    projects:Object,
    pOk:Object,
    pCancel:Object,
    code:null
})
const code = ref(prop.code)
const search = ()=>{
    useForm({}).get(route('orders.list',{code:code.value}))
}
const separate = (price) => {
    return tools.separate(price);
}
</script>
