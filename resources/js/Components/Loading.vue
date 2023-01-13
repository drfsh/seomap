<template>
    <div class="loading" :style="'border-top-color:'+color"></div>
</template>
<script setup>
defineProps({
    color: {default: '#fff'}
});

</script>
