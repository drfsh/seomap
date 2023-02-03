<template>

    <div>
        <div class="statuses mt-2">
            <Route v-model:page="page" :step="setup"></Route>
            <div class="w-100">
                <OrderAttrsStart :attrs="attrs" :project="project" v-if="page===0"></OrderAttrsStart>
                <OrderAttrsCheck :attrs="attrs" :project="project" v-if="page===1"></OrderAttrsCheck>
                <OrderWorking :attrs="attrs" :project="project" v-if="page===3"></OrderWorking>
                <OrderFinish :attrs="attrs" :project="project" v-if="page===4"></OrderFinish>
                <OrderFinished :attrs="attrs" :project="project" v-if="page===5"></OrderFinished>
            </div>
        </div>
    </div>
</template>

<script setup>

import {ref} from "vue";
import OrderAttrsStart from "@/Pages/Admin/Order/OrderAttrsStart.vue";
import OrderAttrsCheck from "@/Pages/Admin/Order/OrderAttrsCheck.vue";
import OrderFinish from "@/Pages/Admin/Order/OrderFinish.vue";
import OrderFinished from "@/Pages/Admin/Order/OrderFinished.vue";
import Route from "@/Components/Orders/Route.vue";
import OrderWorking from "@/Pages/Admin/Order/OrderWorking.vue";

const prop = defineProps(['attrs', 'project'])
const page = ref(0)
const sentAllAttrs = ref(null)
const setup = ref(prop.project.status)
const startAttrs = prop.attrs.startAttrs


page.value = setup.value===2?1:setup.value

for (const i in startAttrs) {
    if (startAttrs[i].value == null && startAttrs[i].description == null) {
        sentAllAttrs.value = false
    }
}
if (sentAllAttrs.value == null && startAttrs)
    sentAllAttrs.value = true
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
        axios.post(route('admin.order.attr.edit', {id: prop.attrs.processing[0].project_id}), {
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
