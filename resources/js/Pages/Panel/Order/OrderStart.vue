<template>
    <div class="position-relative">
        <span class="data-left" style="right: unset; left: 17px; top: -1px;">
                    {{attrs.startInfo[0].created_at_fa}}
        </span>
        <div class="min-title">توضیحات کارشناس فنی</div>
        <div class="order-detail mt-3 order-info" v-html="prop.attrs.setupDescription[0].description"></div>
    </div>
    <OrderAttrsFiles  :project="project" :attrs="attrs"></OrderAttrsFiles>
    <div>
        <div class="min-title">اطلاعات پروژه و هزینه پیاده سازی</div>
        <div class="order-detail mt-3">
            <div class="row">
                <div class="col-lg-4 p-0 border-0 text-center">
                    <span>برآورد هزینه کل پروژه : </span>
                    <span>
                        <span class="d-inline-block price-edit fw-bold" style="padding: 14px;">
                        {{separate(project.fee)}} تومان
                    </span>
                    </span>
                </div>
                <div class="col-lg-4 p-0 border-0 text-center">
                    <span>پیش پرداخت اولیه : </span>
                    <span class="d-inline-block price-edit fw-bold bg-bg" style="padding: 14px;">
                        {{separate(project.paid)}} تومان
                    </span>
                </div>
                <div class="col-lg-4 p-0 border-0 text-center">
                    <span>هزینه مانده پروژه : </span>
                    <span class="d-inline-block price-edit fw-bold bg-green" style="padding: 14px;">
                        {{separate(project.fee-project.paid)}} تومان
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="min-title">روش پرداخت هزینه ئروژه</div>
        <div class="order-detail py-3 mt-3">
            <div class="row attrs">
                <div class="col-12 col-lg-6 px-1">
                    <div class="item d-flex align-items-center m-0 p-2">
                        <div>60 درصد هزینه کل پروژه به عنوان پیش پرداخت کلی میباشد</div>
                        <div class="price-edit bg-bg py-3  fw-bold">{{separate(onePrice)}} تومان</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 px-1">
                    <div  class="item d-flex align-items-center m-0 p-2">
                        <div>60 درصد هزینه کل پروژه به عنوان پیش پرداخت کلی میباشد</div>
                        <div class="price-edit bg-bg py-3 fw-bold">{{separate(twoPrice)}} تومان</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div>
        <div class="min-title">مدت زمان اجرا و پیاده سازی</div>
        <div class="p-3 px-0">
            <div class="attrs justify-content-between">
                <div class="item d-flex align-items-center p-3">
                    <div>
                        <ic_timer></ic_timer>
                        مدت زمان اجرایی از طراحی تا پیاده سازی
                    </div>
                    <div class="price-edit py-3 px-3" style="width: auto;text-align: center;">
                        {{project.days}}
                        روز کاری
                    </div>
                </div>
                <div class="item d-flex align-items-center p-3">
                    <div>
                        <ic_list_search></ic_list_search>
                        تست, اصلاحات و تغییرات نهایی
                    </div>
                    <div class="price-edit py-3" style="width: auto;padding:0 23px;text-align: center;">7 روز کاری</div>
                </div>
                <div class="item d-flex align-items-center p-3">
                    <div>
                        <ic_list></ic_list>
                        تحویل پروژه
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div v-if="project.status===1" class="mt-3 text-start">
        <a :href="route('order.start',{id:project.id})">
            <button style="padding: 11px 18px;" class="me-2 btn btn--primary">
                پرداخت صورت حساب جاری
            </button>
        </a>
    </div>
</template>

<script setup>
import {computed, ref} from "vue";
import tools from "@/Utils/tools.js";
import Ic_timer from "@/Components/svgs/ic_timer.vue";
import Ic_list_search from "@/Components/svgs/ic_list_search.vue";
import Ic_list from "@/Components/svgs/ic_list.vue";
import Loading from "@/Components/Loading.vue";
import OrderAttrsFiles from "@/Pages/Panel/Order/OrderAttrsFiles.vue";

const prop = defineProps(['attrs','project'])
const separate = (price) => {
    return tools.separate(price);
}
const onePrice = computed(()=>{
    return (prop.project.fee-prop.project.paid)/100*60
})
const twoPrice = computed(()=>{
    return (prop.project.fee-prop.project.paid)/100*40
})

</script>
