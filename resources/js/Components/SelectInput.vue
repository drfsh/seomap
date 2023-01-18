<script setup>
import {onMounted, ref} from 'vue';
import TomSelect from "tom-select";

defineProps(['modelValue', 'options','n']);

defineEmits(['update:modelValue']);

const input = ref(null);
let tomSelectGlobalConfigs = {
    render: {
        no_results: function (data, escape) {
            return `<div class="no-results">نتیجه‌ای پیدا نشد!</div>`;
        },
    },
};
onMounted(() => {
    new TomSelect(input.value, {
        maxItems: 1,
        ...tomSelectGlobalConfigs,
    });
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({focus: () => input.value.focus()});
</script>

<template>
    <select ref="input" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"
            id="content-tun-select" class="form-select">
        <option v-if="!n" value="">انتخاب کنید</option>
        <option :value="i" v-for="(v,i) in options">{{ v }}</option>
    </select>
</template>
