<template>

    <div>
        <div class="min-title">وضعیت</div>
        <div v-if="attrs.processing" class="attrs" style="flex-wrap: nowrap;">
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
        <div class="attrs" v-else>
            <div class="item" role="button" @click="startProcessing">
                <div class="order-detail__item">
                    شروع فرایند
                </div>
            </div>
        </div>
    </div>
    <div v-if="attrs.description">
        <div class="min-title">توضیحات سئومپ</div>
        <div class="order-detail mt-3">
            <p class="order-info">
                {{ attrs.description.description }}
            </p>
        </div>
    </div>
    <div>
        <div class="min-title">ویژگی ها</div>
        <div class="attrs">
            <div class="item" v-if="project.attr_new">
                <div class="order-detail__item">
                      <span>
                        <img src="/images/icons/Sitetype.svg" alt="">
                        پیاده سازی با :
                      </span>
                    <strong> &nbsp; {{ project.attr_new.platform.name }} </strong>
                </div>
            </div>
            <AttrItem v-for="v in attrs.dev" :key="v.id" :v="v"></AttrItem>

            <div class="item" role="button" @click="addAttr('dev')">
                <div class="order-detail__item">
                    افزودن ویژگی توسعه
                </div>
            </div>

            <hr style="width: 100%;color: transparent;margin: 0;">
            <AttrItem v-for="v in attrs.lng" :key="v.id" :v="v"></AttrItem>
            <div class="item" role="button" @click="addAttr('lng')">
                <div class="order-detail__item">
                    افزودن زبان
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import AttrItem from "@/Components/Orders/AttrItem.vue";

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
