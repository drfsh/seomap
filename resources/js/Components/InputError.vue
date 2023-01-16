<script setup>
defineProps(['message']);
</script>

<template>
    <div v-show="message">
        <span class="text-sm text-red-600" style="
    background: #e46e6e;
    border-radius: 11px;
    padding: 2px 10px;
    color: white;
    font-size: 14px;
    font-weight: 600;">
            {{ message }}
        </span>
    </div>
</template>
