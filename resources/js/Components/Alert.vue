<template>
<div v-if="message" class="alert--">
    <img src="/images/icons/tick-ok.svg">
    {{message}}
</div>
</template>

<script setup>
defineProps(['message'])
</script>
