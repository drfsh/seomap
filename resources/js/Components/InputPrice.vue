<template>
    <input type="text" class="add-inputs" id="price" v-model="v" @focus="removeToman($event)"
           @focusout="setToman($event)" @input="changePrice($event)" :placeholder="title"/>
</template>

<script setup>
import tools from "../Utils/tools.js";
import {onMounted, ref} from "vue";

const props = defineProps({
    title: String,
    modelValue: String,
    currency: {
        default: 'تومان'
    },
})
const emit = defineEmits(['update:modelValue']);

const v = ref('')
const numberFa = ref([
    '۰',
    '۱',
    '۲',
    '۳',
    '۴',
    '۵',
    '۶',
    '۷',
    '۸',
    '۹',
])

const changePrice = (e)=>{
    let oldValue = e.target.value
    console.log(oldValue)
    let value = []


    for (const i in oldValue) {
        if (numberFa.value.indexOf(oldValue[i]) !== -1) {
            value += numberFa.value.indexOf(oldValue[i])
        } else
            value += oldValue[i]
    }


    value = value.replaceAll(/\D/g, '')
    value = value.replaceAll(',', '')
    value = value.replaceAll(' ' + props.currency + ' ', '')


    v.value = tools.separate(value)
    emit('update:modelValue', value)
}
const   setToman = (e)=> {
    let value = e.target.value
    if (value.trim() === '') return
    e.target.value = value + ' ' + props.currency + ' '
}

const  removeToman = (e)=>{
    let value = e.target.value
    value = value.replaceAll(' ' + props.currency + ' ', '')
    e.target.value = value
}

if (props.modelValue !== '')
    v.value = tools.separate(props.modelValue) + ' ' + props.currency + ' '

</script>
