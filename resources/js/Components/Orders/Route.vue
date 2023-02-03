<template>
    <div class="my-3 order-detail p50">
        <div class="route">
            <div role="button" @click="openPage(0)" :class="{'active':step>0,'select':page===0}" class="item">
                <ic_list></ic_list>
                <span>اطلاعات</span>
            </div>
            <span class="line">
                <span class="bg" :style="'width: '+((step>1)?100:(step===1?50:0))+'%;'"></span>
            </span>
            <div role="button" class="item" @click="openPage(1)" :class="{'active':step>1,'select':page===1}">
                <ic_list_search></ic_list_search>
                <span>بررسی اطلاعات</span>
            </div>
            <span class="line">
                <span class="bg" :style="'width: '+((step>2)?100:(step===2?50:0))+'%;'"></span>
            </span>
            <div role="button" class="item" @click="openPage(3)" :class="{'active':step>2,'select':page===3}">
                <ic_list></ic_list>
                <span>درحال انجام</span>
            </div>
            <span class="line">
                <span class="bg" :style="'width: '+((step>3)?100:(step===3?50:0))+'%;'"></span>
            </span>
            <div role="button" class="item" @click="openPage(4)" :class="{'active':step>3,'select':page===4}">
                <ic_list></ic_list>
                <span>ارسال دمو</span>
            </div>
            <span class="line">
                            <span class="bg" :style="'width: '+((step>4)?100:(step===4?50:0))+'%;'"></span>
                        </span>
            <div role="button" class="item" @click="openPage(5)" :class="{'active':step===5,'select':page===5}">
                <ic_list></ic_list>
                <span>تحویل پروژه</span>
            </div>
        </div>
    </div>
</template>

<script setup>
import Ic_list from "@/Components/svgs/ic_list.vue";
import Ic_list_2 from "@/Components/svgs/ic_list_2.vue";
import Ic_list_search from "@/Components/svgs/ic_list_search.vue";
import {ref} from "vue";

const prop = defineProps(['page', 'step', 'type'])
const emit = defineEmits(['update:page'])
const openPage = (i) => {
    if (prop.step !== 0) {
        if (i <= prop.step) {
            emit('update:page', i)
        }
    } else if (i < prop.step) {
        emit('update:page', i)
    }
}
</script>
