<template>
    <PanelLayout>
        <div class="content__card">
            <div class="content__card__head">
                <h2 class="content__card__head__title">
                    <img :src="'/images/icons/notifications/'+notification.icon+'.svg'" alt="">
                    {{notification.title}}
                </h2>
                <Link :href="route('notification.list')" class="btn btn--outline-primary">
                    بازگشت
                </Link>
            </div>
            <div class="content__card__body">
                <div class="notification__detail">
                    <div v-html="notification.body"></div>
                    <p>
                        <strong>دوست دار شما - {{ notification.user }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </PanelLayout>
</template>

<script setup>
import {Link} from '@inertiajs/inertia-vue3'
import PanelLayout from "@/Layouts/PanelLayout.vue";

const prop = defineProps({
    notification: Object
})
</script>
