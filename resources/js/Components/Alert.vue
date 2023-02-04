<template>
<div v-if="message && show" class="alert--">
    <img src="/images/icons/tick-ok.svg">
    {{message}}
</div>
</template>

<script setup>
import {ref, watch} from "vue";

const prop = defineProps(['message'])
const show = ref(true)

let timer = setInterval(()=>{
    if (prop.message){
        setTimeout(()=>{
            show.value = false
        },5000)
        clearInterval(timer)
    }
})
</script>
