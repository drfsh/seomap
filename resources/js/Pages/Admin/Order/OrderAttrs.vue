<template>

    <div>
        <div class="min-title mb-3">وضعیت</div>
        <div class="d-flex">
            <div>
                <div class="attrs" style="flex-wrap: nowrap">
                    <div class="item" style="white-space: nowrap" role="button">
                        <div class="order-detail__item">
                    <span>
                        <img src="/images/icons/receipt-2.svg" alt="">
                        مرحله :
                    </span>
                            <strong class="me-2">شروع</strong>
                            <ic_tick_green :class="{'opacity-0':!attrs.start}" class=" me-2"></ic_tick_green>
                        </div>
                    </div>
                </div>
                <div class="attrs" style="flex-wrap: nowrap">
                    <div class="item" style="white-space: nowrap" role="button">
                        <div class="order-detail__item">
                    <span>
                        <img src="/images/icons/receipt-2.svg" alt="">
                        مرحله :
                    </span>
                            <strong class="me-2">بررسی</strong>
                            <ic_tick_green  :class="{'opacity-0':!attrs.check}" class="me-2"></ic_tick_green>
                        </div>
                    </div>
                </div>
                <div class="attrs" style="flex-wrap: nowrap">
                    <div class="item" style="white-space: nowrap" role="button">
                        <div class="order-detail__item">
                    <span>
                        <img src="/images/icons/receipt-2.svg" alt="">
                        مرحله :
                    </span>
                            <strong class="me-2">تست</strong>
                            <ic_tick_green :class="{'opacity-0':!attrs.test}" class="me-2"></ic_tick_green>
                        </div>
                    </div>
                </div>
                <div class="attrs" style="flex-wrap: nowrap">
                    <div class="item" style="white-space: nowrap" role="button">
                        <div class="order-detail__item">
                    <span>
                        <img src="/images/icons/receipt-2.svg" alt="">
                        مرحله :
                    </span>
                            <strong class="me-2">تحویل</strong>
                            <ic_tick_green :class="{'opacity-0':!attrs.finish}" class="me-2"></ic_tick_green>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100">
                <div class="attrs" style="flex-wrap: nowrap">
                    <div class="item w-100" style=";padding: 20px">
                        <div class="order-detail__item flex-wrap justify-content-between" style="z-index: 6;position: relative">
                            <div class="d-flex flex-wrap">
                                <div class="item-processing ms-3">
                                    <label class="switch-toggles">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                    <div class="me-2">دریافت اطلاعات</div>
                                </div>
                                <div class="item-processing mx-3">
                                    <img src="/images/icons/calendar.svg" alt="">
                                    <div class="me-2">ویژگی ها</div>
                                </div>
                                <div class="item-processing mx-3">
                                    <img src="/images/icons/status.svg" alt="">
                                    <div class="me-2">توضیحات</div>
                                </div>
                            </div>
                            <div class="me-3">
                                <button style="padding: 4px 18px;" class="me-2 btn btn--primary outline">
                                    <b>
                                    ارسال به مشتری
                                    </b>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div v-if="attrs.processing && false" class="attrs" style="flex-wrap: nowrap;">
        <div class="item" style="white-space: nowrap" @click="changeProcessingName" role="button">
            <div class="order-detail__item">
                                  <span>
                                    <img src="/images/icons/receipt-2.svg" alt="">
                                    مرحله :
                                  </span>
                <strong> {{ attrs.processing[0].name }}</strong>
            </div>
        </div>
        <div class="item processing" @click="changeProcessing"
             :style="'--proccess:'+attrs.processing[0].value+'%'" role="button">
            <div class="order-detail__item" style="z-index: 6;position: relative;">
                                  <span>
                                    <img src="/images/icons/receipt-disscount.svg" alt="">
                                    پیشروی :
                                  </span>
                <strong>% {{ attrs.processing[0].value }} </strong>
            </div>
        </div>
    </div>

</template>

<script setup>
import AttrItem from "@/Components/Orders/AttrItem.vue";
import Ic_tick_blue from "@/Components/svgs/ic_tick_blue.vue";
import Ic_tick_green from "@/Components/svgs/ic_tick_green.vue";

const prop = defineProps(['attrs','project'])
const changeProcessing = () => {
    let person = prompt("درصد را وارد کنید")
    if (person == null || person == "") {

    } else {
        prop.attrs.processing[0].value = person
        axios.post(route('admin.order.attr.edit', {id: prop.attrs.processing[0].project_id}), {
            type: 'processing',
            name: prop.attrs.processing[0].name,
            value: person,
            des: "0",
        })
    }
}
const changeProcessingName = () => {
    let person = prompt("مرحله را وارد کنید")
    if (person == null || person == "") {

    } else {
        prop.attrs.processing[0].name = person
        axios.post(route('admin.order.attr.edit', {id:prop.attrs.processing[0].project_id}), {
            type: 'processing',
            name: person,
            value: prop.attrs.processing[0].value,
            des: "0",
        })
    }
}
const addAttr = (type) => {

    let name = prompt("نام ویژگی")
    if (name == null || name == "") return
    let des = prompt("مقدار ویژگی")
    if (des == null || des == "") return;


    if (prop.attrs[type] == null || prop.attrs[type] == undefined)
        prop.attrs[type] = []

    let data = {
        type: type,
        name: name,
        value: '0',
        description: des,
        project_id: prop.project.id,
    }
    prop.attrs[type].push(data)
    axios.post(route('admin.order.attr.store'), data)

}
const startProcessing = () => {
    let type = 'processing'
    let name = prompt("مرحله را وارد کنید")
    if (name == null || name == "") return
    let des = prompt("درصد پیشرفت")
    if (des == null || des == "") return;


    if (prop.attrs[type] == null || prop.attrs[type] == undefined)
        prop.attrs[type] = []

    let data = {
        type: type,
        name: name,
        value: des,
        description: "0",
        project_id: prop.project.id,
    }
    prop.attrs[type].push(data)
    axios.post(route('admin.order.attr.store'), data)

}
</script>
