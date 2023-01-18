<template>
    <div v-if="show"   class="item position-relative">
        <ic_times_square  @click="close" style="width: 17px;position: absolute;top: -4px;left: 0;"></ic_times_square>
        <div class="order-detail__item" @click="edit" role="button">
              <span>
                <img v-if="v.type==='dev'" src="/images/icons/Sitetype.svg" alt="">
                <img v-if="v.type==='lng'" src="/images/icons/language.svg" alt="">
                {{ v.name }} :
              </span>
            <strong>{{ v.description }}</strong>
        </div>
    </div>
</template>

<script setup>
import Ic_times_square from "@/Components/svgs/ic_times_square.vue";
import {ref} from "vue";

const prop = defineProps(['v','icon'])
const show = ref(true)
const close = () => {
    axios.delete(route('admin.order.attr.delete', {id: prop.v.id}))
    show.value = false
}
const edit = () => {
    let name = prompt("نام ویژگی")
    if (name == null || name == "") return
    let des = prompt("مقدار ویژگی")
    if (des == null || des == "") return;

        prop.v.name = name
        prop.v.description = des
        axios.post(route('admin.order.attr.edit', {id: prop.v.project_id}), {
            type: prop.v.type,
            name: name,
            value: prop.v.value,
            des: des,
        })

}
</script>
