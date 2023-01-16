<template>
    <div class="ticket__message" :class="{admin:message.user.admin}">
        <div class="ticket__message__avatar"><img :src="message.user.profile" alt="avatar"></div>
        <div class="ticket__message__body">
            <div class="ticket__message__body__text">
                <div v-if="message.file" style="margin-bottom: 10px;border: 1px solid;background: white;border-radius: 5px;display: flex;align-items: center;padding: 6px;">
                    <img src="/images/icons/frame.svg" alt="">
                    <a target="_blank" style="margin: 0 8px;color: #626262;" :href="message.file">باز کردن فایل</a>
                </div>
                <div  v-html="message.text"></div>
                <div v-if="message.user.admin" style="color: rgb(185 185 185);font-size: 12px;margin-top: 12px;">{{message.user.name}}</div>
            </div>
            <div class="ticket__message__body__date"><span>{{message.updated_at[0]}}</span> <span>{{message.updated_at[1]}}</span></div>
        </div>
    </div>
</template>

<script setup>
const prop = defineProps({
    message:Object
})
</script>

<style scoped>

</style>