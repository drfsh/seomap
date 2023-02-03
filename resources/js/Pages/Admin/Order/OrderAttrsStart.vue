<template>
    <Alert class="my-3" :message="alert"></Alert>
    <OrderRequestFiles :project="project" :attrs="attrs"></OrderRequestFiles>
    <div>
        <div class="min-title">توضیحات کارشناس فنی
        </div>
        <div class="order-detail mt-3">
            <div>
                <div class="col-12">
                    <div class="input-group">
                        <textarea style="height: 160px;" v-model="form.description" type="text" class="form-control" placeholder="توضیحات"></textarea>
                    </div>
                    <InputError :message="form.errors.description"></InputError>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="min-title">اطلاعات پروژه و هزینه پیاده سازی</div>
        <div class="order-detail mt-3">
            <div class="row">
                <div class="col-lg-4 p-0 border-0 text-center">
                    <span>برآورد هزینه کل پروژه : </span>
                    <span>
                        <Input_price v-model="form.price" class=" fw-bold price-edit"></Input_price>
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
                        {{separate(form.price-project.paid)}} تومان
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
                    <div class="price-edit py-3" style="width: auto;padding-left: 23px;text-align: center;">
                        <input v-model="form.days" type="number" style="height: 16px;width: 32px;background: transparent;border: none;color: white;text-align: left;">
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
    <div class="mt-3 text-start">
        <button v-if="project.status===0" @click="submit" style="padding: 11px 18px;" class="me-2 btn btn--primary outline">
            <b v-if="!form.processing">
                <b v-if="project.status===0">ارسال اطلاعات به مشتری</b>
                <b v-else>ویرایش</b>
            </b>
            <Loading v-else color="#2f5bea"></Loading>
        </button>
    </div>
</template>

<script setup>
import OrderRequestFiles from "@/Pages/Admin/Order/OrderRequestFiles.vue";
import {computed, ref} from "vue";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import Input_price from "@/Components/InputPrice.vue";
import tools from "@/Utils/tools.js";
import Ic_timer from "@/Components/svgs/ic_timer.vue";
import Ic_settings from "@/Components/svgs/ic_settings.vue";
import Ic_list_search from "@/Components/svgs/ic_list_search.vue";
import Ic_list from "@/Components/svgs/ic_list.vue";
import Loading from "@/Components/Loading.vue";
import Alert from "@/Components/Alert.vue";

const prop = defineProps(['attrs','project'])
const separate = (price) => {
    return tools.separate(price);
}
const onePrice = computed(()=>{
    return (form.price-prop.project.paid)/100*60
})
const twoPrice = computed(()=>{
    return (form.price-prop.project.paid)/100*40
})
const form = useForm({
    description:prop.attrs.setupDescription?prop.attrs.setupDescription[0].description:null,
    price:prop.project.fee,
    days:prop.project.days,
    id:prop.project.id,
})
const alert = ref('')
const submit = () => {
  form.post(route('admin.order.setup'),{
      onSuccess:()=>{
          alert.value = 'ارسال شد!'
          location.reload();
      }
  })
}
</script>
