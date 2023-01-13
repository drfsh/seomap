<template>
    <div class="login-page">
        <img src="/images/logo.png"/>
        <slot />
    </div>
    <div class="info-req">
        با ورود یا سئومپ شما <a href="#">شرایط و قوانین</a> استفاده از سرویس های سایت سئومپ و <a href="#">قوانین حریم خصوصی</a> آن را میپذیریم
    </div>
</template>

<script setup>
import {onMounted,onUnmounted} from "vue";
onMounted(()=>{
    document.querySelector('html').className = 'auth-layout'
})
onUnmounted(()=>{
    document.querySelector('html').className = ''
})
</script>
